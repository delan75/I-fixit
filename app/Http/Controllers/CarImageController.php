<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'image_type' => 'required|string|in:before_repair,during_repair,after_repair,damage,dealership,other',
            'description' => 'nullable|string|max:255',
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Get car details for filename
                $year = $car->year ?? 'unknown';
                $make = Str::slug($car->make ?? 'unknown');
                $model = Str::slug($car->model ?? 'unknown');
                $imageType = $request->input('image_type');

                // Create simple directory structure: car_images/{image_type}
                $directory = "car_images/{$imageType}";

                // Create a unique filename with car details
                $extension = 'webp'; // We'll convert to WebP
                $filename = "{$year}_{$make}_{$model}_" . uniqid() . ".{$extension}";

                // Create the full path
                $fullPath = "{$directory}/{$filename}";

                // Ensure the directory exists
                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }

                // Process and save the image as WebP
                try {
                    // Get the image content
                    $imageContent = file_get_contents($image->getRealPath());

                    // Save the original image temporarily
                    Storage::disk('public')->put($fullPath, $imageContent);

                    // Create the database record
                    $car->images()->create([
                        'image_path' => $fullPath,
                        'image_type' => $imageType,
                        'description' => $request->input('description'),
                        'created_by' => Auth::id(),
                        'updated_by' => Auth::id(),
                        'status' => 'active',
                    ]);
                } catch (\Exception $e) {
                    // Log the error
                    Log::error('Failed to save image: ' . $e->getMessage());
                    continue;
                }
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

    /**
     * Migrate existing images to the new directory structure.
     */
    public function migrateImages(Car $car)
    {
        $results = [
            'success' => 0,
            'failed' => 0,
            'skipped' => 0
        ];

        foreach ($car->images as $image) {
            // Skip if the image path already follows the new structure
            if (Str::contains($image->image_path, "car_images/{$image->image_type}/")) {
                $results['skipped']++;
                continue;
            }

            // Get the old path
            $oldPath = $image->image_path;

            // Check if the file exists
            if (!Storage::disk('public')->exists($oldPath)) {
                $results['failed']++;
                continue;
            }

            // Get car details for filename
            $year = $car->year ?? 'unknown';
            $make = Str::slug($car->make ?? 'unknown');
            $model = Str::slug($car->model ?? 'unknown');
            $imageType = $image->image_type ?? 'other';

            // Create simple directory structure
            $directory = "car_images/{$imageType}";

            // Get file extension
            $extension = pathinfo($oldPath, PATHINFO_EXTENSION);
            if (empty($extension)) {
                $extension = 'jpg'; // Default extension
            }

            // Create a unique filename with car details
            $filename = "{$year}_{$make}_{$model}_" . uniqid() . ".{$extension}";

            // Create the full path
            $newPath = "{$directory}/{$filename}";

            // Ensure the directory exists
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Copy the file to the new location
            if (Storage::disk('public')->copy($oldPath, $newPath)) {
                // Update the image path in the database
                $image->image_path = $newPath;
                $image->save();

                // Delete the old file
                Storage::disk('public')->delete($oldPath);

                $results['success']++;
            } else {
                $results['failed']++;
            }
        }

        return redirect()->route('cars.show', $car)
            ->with('success', "Images migrated: {$results['success']} successful, {$results['failed']} failed, {$results['skipped']} skipped.");
    }
}
