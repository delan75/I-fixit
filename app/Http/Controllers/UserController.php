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
    public function index()
    {
        // Check if user has permission to view users
        Gate::authorize('view-users');

        // Get all users (both active and inactive)
        $users = User::orderBy('status') // Order by status to group active and inactive users
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

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,user'],
        ]);

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

        // Only admin can change roles
        if (Auth::user()->role === 'admin' && isset($validated['role'])) {
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
        if (Auth::user()->role === 'admin') {
            // Admin can permanently delete, but must confirm with password
            $this->authorize('delete', $user);

            // Validate the password
            $request->validate([
                'password' => 'required',
            ]);

            // Verify the admin's password
            if (!Hash::check($request->password, Auth::user()->password)) {
                return redirect()->route('users.index')
                    ->with('error', 'Incorrect password. User was not deleted.');
            }

            // Password is correct, proceed with deletion
            $user->delete();
            $message = 'User permanently deleted successfully.';
        } else {
            // Regular users cannot delete users
            abort(403, 'Unauthorized action.');
        }

        return redirect()->route('users.index')
            ->with('success', $message);
    }

    /**
     * Soft delete the specified resource.
     */
    public function softDelete(User $user)
    {
        // Check if user has permission to soft delete this user
        $this->authorize('softDelete', $user);

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
