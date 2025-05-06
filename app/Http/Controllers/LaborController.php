<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Labor;
use Illuminate\Http\Request;

class LaborController extends Controller
{
    /**
     * Show the form for creating a new labor entry.
     */
    public function create(Car $car)
    {
        return view('labor.create', compact('car'));
    }

    /**
     * Store a newly created labor entry in storage.
     */
    public function store(Request $request, Car $car)
    {
        // Validate the request
        $validated = $request->validate([
            'service_type' => 'required|string|max:255',
            'description' => 'required|string',
            'provider_name' => 'required|string|max:255',
            'provider_contact' => 'nullable|string|max:255',
            'hours' => 'nullable|numeric|min:0',
            'hourly_rate' => 'nullable|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'service_date' => 'required|date',
            'completion_date' => 'nullable|date',
        ]);

        // Create the labor entry
        $labor = $car->laborEntries()->create($validated);

        return redirect()->route('cars.show', $car)
            ->with('success', 'Labor entry added successfully.');
    }

    /**
     * Show the form for editing the specified labor entry.
     */
    public function edit(Car $car, Labor $labor)
    {
        return view('labor.edit', compact('car', 'labor'));
    }

    /**
     * Update the specified labor entry in storage.
     */
    public function update(Request $request, Car $car, Labor $labor)
    {
        // Validate the request
        $validated = $request->validate([
            'service_type' => 'required|string|max:255',
            'description' => 'required|string',
            'provider_name' => 'required|string|max:255',
            'provider_contact' => 'nullable|string|max:255',
            'hours' => 'nullable|numeric|min:0',
            'hourly_rate' => 'nullable|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'service_date' => 'required|date',
            'completion_date' => 'nullable|date',
        ]);

        // Update the labor entry
        $labor->update($validated);

        return redirect()->route('cars.show', $car)
            ->with('success', 'Labor entry updated successfully.');
    }

    /**
     * Remove the specified labor entry from storage.
     */
    public function destroy(Car $car, Labor $labor)
    {
        // Delete the labor entry
        $labor->delete();

        return redirect()->route('cars.show', $car)
            ->with('success', 'Labor entry deleted successfully.');
    }
}
