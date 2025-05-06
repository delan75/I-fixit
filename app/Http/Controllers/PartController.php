<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Part;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Show the form for creating a new part.
     */
    public function create(Car $car)
    {
        $suppliers = Supplier::orderBy('name')->get();
        return view('parts.create', compact('car', 'suppliers'));
    }

    /**
     * Store a newly created part in storage.
     */
    public function store(Request $request, Car $car)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'condition' => 'required|in:new,used,refurbished',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'installation_date' => 'nullable|date',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        // Calculate total price
        $totalPrice = $validated['quantity'] * $validated['unit_price'];

        // Create the part
        $part = $car->parts()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'condition' => $validated['condition'],
            'quantity' => $validated['quantity'],
            'unit_price' => $validated['unit_price'],
            'total_price' => $totalPrice,
            'purchase_date' => $validated['purchase_date'],
            'installation_date' => $validated['installation_date'],
            'supplier_id' => $validated['supplier_id'],
        ]);

        return redirect()->route('cars.show', $car)
            ->with('success', 'Part added successfully.');
    }

    /**
     * Show the form for editing the specified part.
     */
    public function edit(Car $car, Part $part)
    {
        $suppliers = Supplier::orderBy('name')->get();
        return view('parts.edit', compact('car', 'part', 'suppliers'));
    }

    /**
     * Update the specified part in storage.
     */
    public function update(Request $request, Car $car, Part $part)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'condition' => 'required|in:new,used,refurbished',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'installation_date' => 'nullable|date',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        // Calculate total price
        $totalPrice = $validated['quantity'] * $validated['unit_price'];

        // Update the part
        $part->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'condition' => $validated['condition'],
            'quantity' => $validated['quantity'],
            'unit_price' => $validated['unit_price'],
            'total_price' => $totalPrice,
            'purchase_date' => $validated['purchase_date'],
            'installation_date' => $validated['installation_date'],
            'supplier_id' => $validated['supplier_id'],
        ]);

        return redirect()->route('cars.show', $car)
            ->with('success', 'Part updated successfully.');
    }

    /**
     * Remove the specified part from storage.
     */
    public function destroy(Car $car, Part $part)
    {
        // Delete the part
        $part->delete();

        return redirect()->route('cars.show', $car)
            ->with('success', 'Part deleted successfully.');
    }
}
