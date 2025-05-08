<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if user has permission to view users
        Gate::authorize('view-users');

        // Start with a base query
        $query = User::query();

        // If user is admin but not superuser, exclude superusers from the listing
        if (Auth::user()->isAdmin() && !Auth::user()->isSuperuser()) {
            $query->where('is_superuser', false);
        }

        // Apply filters if provided
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // Apply search if provided
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        // Order by status and name, then paginate
        $users = $query->orderBy('status')
                       ->orderBy('name')
                       ->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if user has permission to create users
        Gate::authorize('admin-action');

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if user has permission to create users
        Gate::authorize('admin-action');

        $validationRules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,user'],
        ];

        // Only superusers can create other superusers
        if (Auth::user()->isSuperuser()) {
            $validationRules['is_superuser'] = ['sometimes', 'boolean'];
        }

        $request->validate($validationRules);

        // Sanitize and prepare data
        $userData = [
            'first_name' => trim($request->first_name),
            'last_name' => trim($request->last_name),
            'name' => "{$request->first_name} {$request->last_name}",
            'email' => strtolower(trim($request->email)),
            'phone' => trim($request->phone),
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'active',
            'created_by' => Auth::id(),
        ];

        // Set superuser status if the current user is a superuser and the field was provided
        if (Auth::user()->isSuperuser() && $request->has('is_superuser')) {
            $userData['is_superuser'] = (bool) $request->is_superuser;
        } else {
            $userData['is_superuser'] = false;
        }

        $user = User::create($userData);

        // Log user creation for audit purposes
        Log::info('User created', [
            'user_id' => $user->id,
            'created_by' => Auth::id(),
            'role' => $user->role
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Check if user has permission to view this user
        $this->authorize('view', $user);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Check if user has permission to edit this user
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        // The authorization is handled in the form request
        $validated = $request->validated();

        // Update user data
        $user->first_name = trim($validated['first_name']);
        $user->last_name = trim($validated['last_name']);
        $user->name = "{$validated['first_name']} {$validated['last_name']}";
        $user->email = strtolower(trim($validated['email']));
        $user->phone = trim($validated['phone']);
        $user->gender = isset($validated['gender']) ? trim($validated['gender']) : null;

        // Handle role changes
        if (isset($validated['role'])) {
            // Only admin or superuser can change roles
            if (Auth::user()->hasAdminAccess()) {
                // Additional check to prevent the last admin from being demoted
                if ($user->role === 'admin' && $validated['role'] === 'user') {
                    $adminCount = User::where('role', 'admin')->count();
                    if ($adminCount <= 1) {
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(['role' => 'Cannot demote the last admin user.']);
                    }
                }
                $user->role = $validated['role'];
            }
        }

        // Handle superuser status changes
        if (isset($validated['is_superuser'])) {
            // Only superusers can change superuser status
            if (Auth::user()->isSuperuser()) {
                // Prevent removing the last superuser
                if ($user->isSuperuser() && !$validated['is_superuser']) {
                    $superuserCount = User::where('is_superuser', true)->count();
                    if ($superuserCount <= 1) {
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(['is_superuser' => 'Cannot remove the last superuser.']);
                    }
                }
                $user->is_superuser = (bool) $validated['is_superuser'];
            }
        }

        // Update password if provided
        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Set updated_by field
        $user->updated_by = Auth::id();

        $user->save();

        // Log the update for audit purposes
        Log::info('User updated', [
            'user_id' => $user->id,
            'updated_by' => Auth::id(),
            'changes' => $user->getChanges()
        ]);

        return redirect()->route(Auth::user()->role === 'admin' ? 'users.index' : 'profile.edit')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        // Check if user has permission to delete this user
        $this->authorize('delete', $user);

        // Validate the password
        $request->validate([
            'password' => 'required',
        ]);

        // Verify the user's password
        if (!Hash::check($request->password, Auth::user()->password)) {
            return redirect()->route('users.index')
                ->with('error', 'Incorrect password. User was not deleted.');
        }

        // Password is correct, proceed with deletion
        $user->delete();

        // Log the action
        Log::info('User deleted', [
            'deleted_user_id' => $user->id,
            'deleted_by' => Auth::id()
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User permanently deleted successfully.');
    }

    /**
     * Soft delete the specified resource.
     */
    public function softDelete(User $user)
    {
        // Check if user has permission to soft delete this user
        $this->authorize('softDelete', $user);

        // Additional check to prevent deactivating superusers by non-superusers
        if ($user->isSuperuser() && !Auth::user()->isSuperuser()) {
            return redirect()->route('users.index')
                ->with('error', 'You do not have permission to deactivate superusers.');
        }

        // Use direct DB update to bypass model events
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'status' => 'inactive',
                'updated_at' => now()
            ]);

        // Log the action manually with the current user ID
        AuditService::logSoftDeleted($user, Auth::id());

        return redirect()->route('users.index')
            ->with('success', 'User deactivated successfully.');
    }

    /**
     * Restore the specified resource.
     */
    public function restore(User $user)
    {
        // Check if user has permission to restore this user
        $this->authorize('restore', $user);

        // Additional check to prevent restoring superusers by non-superusers
        if ($user->isSuperuser() && !Auth::user()->isSuperuser()) {
            return redirect()->route('users.index')
                ->with('error', 'You do not have permission to activate superusers.');
        }

        // Use direct DB update to bypass model events
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'status' => 'active',
                'updated_at' => now()
            ]);

        // Log the action manually with the current user ID
        AuditService::logRestored($user, Auth::id());

        return redirect()->route('users.index')
            ->with('success', 'User activated successfully.');
    }
}
