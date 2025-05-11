<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get query parameters for filtering
        $search = $request->query('search');
        $createdBy = $request->query('created_by');
        $status = $request->query('status');

        // Start with a base query
        $query = Supplier::query();

        // Apply authorization filter - admin/superuser sees all, users see only their own
        $user = Auth::user();
        if (!$user->hasAdminAccess()) {
            $query->where('created_by', $user->id);
            // Regular users can only see active records
            $query->where('status', 'active');
        } else {
            // Admin and superuser can filter by status if provided
            if ($status) {
                $query->where('status', $status);
            }
        }

        // Apply search filter if provided
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('branch_name', 'like', "%{$search}%")
                  ->orWhere('contact_person', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Apply created_by filter if provided
        if ($createdBy) {
            $query->where('created_by', $createdBy);
        }

        // Get the suppliers with pagination
        $suppliers = $query->orderBy('name')->paginate(10);

        // Get the list of creators for the filter dropdown
        $creators = User::select('id', 'name')->distinct()->get();

        return view('suppliers.index', compact('suppliers', 'search', 'creators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // All authenticated users can create suppliers
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
        ]);

        // Add created_by and updated_by to the validated data
        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();
        $validated['status'] = 'active';

        // Create the supplier
        $supplier = Supplier::create($validated);

        return redirect()->route('suppliers.show', $supplier)
            ->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        // Check if user has permission to view this supplier
        $this->authorize('view', $supplier);

        // Load the parts relationship
        $supplier->load('parts.car');

        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        // Check if user has permission to edit this supplier
        $this->authorize('update', $supplier);

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Check if user has permission to update this supplier
        $this->authorize('update', $supplier);

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
        ]);

        // Add updated_by to the validated data
        $validated['updated_by'] = Auth::id();

        // Update the supplier
        $supplier->update($validated);

        return redirect()->route('suppliers.show', $supplier)
            ->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        // Check if the supplier has any parts
        if ($supplier->parts()->count() > 0) {
            return redirect()->route('suppliers.show', $supplier)
                ->with('error', 'Cannot delete supplier with associated parts.');
        }

        // Check if user has permission to delete this supplier
        if (Auth::user()->hasAdminAccess()) {
            // Admin/Superuser can permanently delete
            $this->authorize('delete', $supplier);
            $supplier->delete();
            $message = 'Supplier permanently deleted successfully.';
        } else {
            // Regular users can only soft delete (mark as inactive)
            $this->authorize('softDelete', $supplier);
            $supplier->status = 'inactive';
            $supplier->updated_by = Auth::id();
            $supplier->save();
            $message = 'Supplier deleted successfully.';
        }

        return redirect()->route('suppliers.index')
            ->with('success', $message);
    }

    /**
     * Restore an inactive supplier.
     */
    public function restore(Supplier $supplier)
    {
        // Only admin/superuser can restore suppliers
        if (!Auth::user()->hasAdminAccess()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the supplier is inactive
        if ($supplier->status !== 'inactive') {
            return redirect()->route('suppliers.show', $supplier)
                ->with('error', 'Supplier is already active.');
        }

        // Restore the supplier
        $supplier->status = 'active';
        $supplier->updated_by = Auth::id();
        $supplier->save();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier reactivated successfully.');
    }
}
