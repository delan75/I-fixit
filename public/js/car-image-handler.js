/**
 * Car Image Handler
 *
 * This script handles car image display, including:
 * - Error handling for images that fail to load
 * - Adding a default placeholder for missing images
 */
document.addEventListener('DOMContentLoaded', function() {
    // Find all image elements in the car gallery
    const galleryImages = document.querySelectorAll('.car-gallery img');

    // Process each image
    galleryImages.forEach(function(img) {
        // Add error handler to each image
        img.onerror = function() {
            handleImageError(img);
        };

        // Check if image is already broken (might have errored before script loaded)
        if (img.complete && img.naturalHeight === 0) {
            handleImageError(img);
        }
    });

    // Handle image loading errors
    function handleImageError(img) {
        // Set a placeholder image - using a data URI for a simple gray placeholder
        img.src = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4MDAiIGhlaWdodD0iNjAwIiB2aWV3Qm94PSIwIDAgODAwIDYwMCI+PHJlY3Qgd2lkdGg9IjgwMCIgaGVpZ2h0PSI2MDAiIGZpbGw9IiNlZWVlZWUiLz48dGV4dCB4PSI0MDAiIHk9IjMwMCIgZm9udC1mYW1pbHk9IkFyaWFsLCBzYW5zLXNlcmlmIiBmb250LXNpemU9IjMwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjOTk5OTk5Ij5JbWFnZSBOb3QgQXZhaWxhYmxlPC90ZXh0Pjwvc3ZnPg==';

        // Add a class for styling
        img.classList.add('image-error');
    }
});
