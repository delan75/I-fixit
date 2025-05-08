<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
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
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
                ]);
            }
        }

        return redirect()->route('cars.show', $car)
            ->with('success', 'Images added successfully.');
    }

    /**
     * Remove the specified car image from storage.
     */
    public function destroy(Car $car, CarImage $carImage)
    {
        // Delete the image file from storage
        Storage::disk('public')->delete($carImage->image_path);

        // Delete the image record
        $carImage->delete();

        return redirect()->route('cars.show', $car)
            ->with('success', 'Image deleted successfully.');
    }
}
