<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Painting;
use Illuminate\Http\Request;

class PaintingController extends Controller
{
    /**
     * Show the form for creating a new painting entry.
     */
    public function create(Car $car)
    {
        return view('painting.create', compact('car'));
    }

    /**
     * Store a newly created painting entry in storage.
     */
    public function store(Request $request, Car $car)
    {
        // Validate the request
        $validated = $request->validate([
            'painting_type' => 'required|in:full,partial',
            'areas_covered' => 'nullable|string',
            'provider_name' => 'required|string|max:255',
            'provider_contact' => 'nullable|string|max:255',
            'material_cost' => 'nullable|numeric|min:0',
            'labor_cost' => 'nullable|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'completion_date' => 'nullable|date',
        ]);

        // Create the painting entry
        $painting = $car->paintingEntries()->create($validated);

        return redirect()->route('cars.show', $car)
            ->with('success', 'Painting entry added successfully.');
    }

    /**
     * Show the form for editing the specified painting entry.
     */
    public function edit(Car $car, Painting $painting)
    {
        return view('painting.edit', compact('car', 'painting'));
    }

    /**
     * Update the specified painting entry in storage.
     */
    public function update(Request $request, Car $car, Painting $painting)
    {
        // Validate the request
        $validated = $request->validate([
            'painting_type' => 'required|in:full,partial',
            'areas_covered' => 'nullable|string',
            'provider_name' => 'required|string|max:255',
            'provider_contact' => 'nullable|string|max:255',
            'material_cost' => 'nullable|numeric|min:0',
            'labor_cost' => 'nullable|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'completion_date' => 'nullable|date',
        ]);

        // Update the painting entry
        $painting->update($validated);

        return redirect()->route('cars.show', $car)
            ->with('success', 'Painting entry updated successfully.');
    }

    /**
     * Remove the specified painting entry from storage.
     */
    public function destroy(Car $car, Painting $painting)
    {
        // Delete the painting entry
        $painting->delete();

        return redirect()->route('cars.show', $car)
            ->with('success', 'Painting entry deleted successfully.');
    }
}
