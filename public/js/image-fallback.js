/**
 * Image Fallback Handler
 * 
 * This script adds error handling for images that fail to load.
 * It replaces broken images with a placeholder and adds a retry mechanism.
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
        // Store the original source for potential retry
        const originalSrc = img.src;
        
        // Set a placeholder image
        img.src = '/images/placeholder-car.jpg';
        
        // Add a class for styling
        img.classList.add('image-error');
        
        // Create a retry button container
        const retryContainer = document.createElement('div');
        retryContainer.className = 'retry-container absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-md';
        
        // Create retry button
        const retryButton = document.createElement('button');
        retryButton.className = 'bg-white text-gray-800 px-2 py-1 rounded text-xs';
        retryButton.textContent = 'Retry Loading';
        
        // Add retry functionality
        retryButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Remove the retry container
            if (retryContainer.parentNode) {
                retryContainer.parentNode.removeChild(retryContainer);
            }
            
            // Try loading the original image again
            img.src = originalSrc + '?retry=' + new Date().getTime();
            
            return false;
        });
        
        // Add button to container
        retryContainer.appendChild(retryButton);
        
        // Add container to the image parent (relative positioning needed)
        const parent = img.parentNode;
        if (parent) {
            // Ensure parent has position relative for absolute positioning of retry button
            if (window.getComputedStyle(parent).position === 'static') {
                parent.style.position = 'relative';
            }
            parent.appendChild(retryContainer);
        }
    }
});
