<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarImageController extends Controller
{
    /**
     * Show the form for creating a new car image.
     */
    public function create(Car $car)
    {
        return view('car_images.create', compact('car'));
    }

    /**
     * Store a newly created car image in storage.
     */
    public function store(Request $request, Car $car)
    {
        // Validate the request
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_type' => 'required|string|in:before_repair,during_repair,after_repair,damage,other',
            'description' => 'nullable|string|max:255',
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('car_images', 'public');

                $car->images()->create([
                    'image_path' => $path,
                    'image_type' => $request->input('image_type'),
                    'description' => $request->input('description'),
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id(),
                    'status' => 'active',
                ]);
            }
        }

        return redirect()->route('cars.show', $car)
            ->with('success', 'Images added successfully.');
    }

    /**
     * Remove the specified car image from storage.
     */
    public function destroy(Car $car, Image $image)
    {
        // Check if the image belongs to the car
        if ($image->imageable_id == $car->id && $image->imageable_type == get_class($car)) {
            if (Auth::user()->role === 'admin') {
                // Admin can permanently delete
                // Delete the image file from storage
                Storage::disk('public')->delete($image->image_path);

                // Permanently delete the image record
                $image->forceDelete();

                return redirect()->route('cars.show', $car)
                    ->with('success', 'Image permanently deleted successfully.');
            } else {
                // Regular users can only soft delete (mark as inactive)
                $image->status = 'inactive';
                $image->updated_by = Auth::id();
                $image->save();

                // Soft delete the image
                $image->delete();

                return redirect()->route('cars.show', $car)
                    ->with('success', 'Image deleted successfully.');
            }
        }

        return redirect()->route('cars.show', $car)
            ->with('error', 'Image not found or does not belong to this car.');
    }
}
