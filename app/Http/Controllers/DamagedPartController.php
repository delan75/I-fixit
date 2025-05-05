<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\DamagedPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DamagedPartController extends Controller
{
    /**
     * Show the form for creating a new damaged part.
     */
    public function create(Car $car)
    {
        return view('damaged_parts.create', compact('car'));
    }

    /**
     * Store a newly created damaged part in storage.
     */
    public function store(Request $request, Car $car)
    {
        // Validate the request
        $validated = $request->validate([
            'part_name' => 'required|string|max:255',
            'part_location' => 'required|string|max:255',
            'damage_description' => 'required|string',
            'estimated_repair_cost' => 'required|numeric|min:0',
            'is_repaired' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the damaged part
        $damagedPart = $car->damagedParts()->create([
            'part_name' => $validated['part_name'],
            'part_location' => $validated['part_location'],
            'damage_description' => $validated['damage_description'],
            'estimated_repair_cost' => $validated['estimated_repair_cost'],
            'is_repaired' => $request->has('is_repaired') ? true : false,
        ]);

        // Handle image uploads if any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('damaged_part_images', 'public');

                $damagedPart->images()->create([
                    'image_path' => $path,
                    'description' => $request->input('image_description'),
                ]);
            }
        }

        return redirect()->route('cars.show', $car)
            ->with('success', 'Damaged part added successfully.');
    }

    /**
     * Show the form for editing the specified damaged part.
     */
    public function edit(Car $car, DamagedPart $damagedPart)
    {
        return view('damaged_parts.edit', compact('car', 'damagedPart'));
    }

    /**
     * Update the specified damaged part in storage.
     */
    public function update(Request $request, Car $car, DamagedPart $damagedPart)
    {
        // Validate the request
        $validated = $request->validate([
            'part_name' => 'required|string|max:255',
            'part_location' => 'required|string|max:255',
            'damage_description' => 'required|string',
            'estimated_repair_cost' => 'required|numeric|min:0',
            'is_repaired' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the damaged part
        $damagedPart->update([
            'part_name' => $validated['part_name'],
            'part_location' => $validated['part_location'],
            'damage_description' => $validated['damage_description'],
            'estimated_repair_cost' => $validated['estimated_repair_cost'],
            'is_repaired' => $request->has('is_repaired') ? true : false,
        ]);

        // Handle image uploads if any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('damaged_part_images', 'public');

                $damagedPart->images()->create([
                    'image_path' => $path,
                    'description' => $request->input('image_description'),
                ]);
            }
        }

        return redirect()->route('cars.show', $car)
            ->with('success', 'Damaged part updated successfully.');
    }

    /**
     * Remove the specified damaged part from storage.
     */
    public function destroy(Car $car, DamagedPart $damagedPart)
    {
        // Delete associated images
        foreach ($damagedPart->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        // Delete the damaged part
        $damagedPart->delete();

        return redirect()->route('cars.show', $car)
            ->with('success', 'Damaged part deleted successfully.');
    }
}
