<?php

namespace App\Services;

use App\Models\Car;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarImageService
{
    /**
     * Store a car image with an organized directory structure
     *
     * @param Car $car
     * @param UploadedFile $image
     * @param string $imageType
     * @return string
     */
    public function storeImage(Car $car, UploadedFile $image, string $imageType): string
    {
        // Create directory structure based on car details
        $year = $car->year ?? 'unknown_year';
        $make = Str::slug($car->make ?? 'unknown_make');
        $model = Str::slug($car->model ?? 'unknown_model');
        $carId = $car->id;

        // Create path: car_images/year/make/model/car_id/image_type/filename
        $directory = "car_images/{$year}/{$make}/{$model}/{$carId}/{$imageType}";

        // Store the image in the public disk with the organized directory structure
        $path = $image->store($directory, 'public');

        return $path;
    }

    /**
     * Get the URL for a placeholder image
     *
     * @return string
     */
    public function getPlaceholderUrl(): string
    {
        return asset('images/placeholder-car.jpg');
    }

    /**
     * Create a placeholder image if it doesn't exist
     *
     * @return void
     */
    public function createPlaceholderIfNotExists(): void
    {
        $placeholderPath = public_path('images/placeholder-car.jpg');
        $placeholderDir = dirname($placeholderPath);

        // Check if the directory exists, if not create it
        if (!file_exists($placeholderDir)) {
            mkdir($placeholderDir, 0755, true);
        }

        // If the placeholder image doesn't exist, copy a default one or create a simple one
        if (!file_exists($placeholderPath)) {
            // Try to copy from a default image if it exists
            $defaultImagePath = public_path('images/default-car.jpg');

            if (file_exists($defaultImagePath)) {
                copy($defaultImagePath, $placeholderPath);
            } else {
                // Create a simple 1x1 pixel transparent image as fallback
                $this->createSimplePlaceholder($placeholderPath);
            }
        }
    }

    /**
     * Create a simple placeholder image without using GD library
     *
     * @param string $path
     * @return void
     */
    private function createSimplePlaceholder(string $path): void
    {
        // Create a simple 1x1 pixel transparent PNG
        $transparentPixel = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=');
        file_put_contents($path, $transparentPixel);
    }

    /**
     * Migrate existing images to the new directory structure
     *
     * @param Car $car
     * @return array
     */
    public function migrateExistingImages(Car $car): array
    {
        $results = [
            'success' => 0,
            'failed' => 0,
            'skipped' => 0
        ];

        foreach ($car->images as $image) {
            // Skip if the image path already follows the new structure
            if (Str::contains($image->image_path, "/{$car->year}/")) {
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

            // Create new path
            $year = $car->year ?? 'unknown_year';
            $make = Str::slug($car->make ?? 'unknown_make');
            $model = Str::slug($car->model ?? 'unknown_model');
            $carId = $car->id;
            $imageType = $image->image_type ?? 'other';
            $filename = basename($oldPath);

            $newDirectory = "car_images/{$year}/{$make}/{$model}/{$carId}/{$imageType}";
            $newPath = "{$newDirectory}/{$filename}";

            // Create directory if it doesn't exist
            if (!Storage::disk('public')->exists($newDirectory)) {
                Storage::disk('public')->makeDirectory($newDirectory);
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

        return $results;
    }
}
