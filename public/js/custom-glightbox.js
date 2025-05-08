// Initialize GLightbox for image galleries
document.addEventListener('DOMContentLoaded', function() {
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Add custom CSS for the image type display and delete button
    const style = document.createElement('style');
    style.textContent = `
        .gslide-title {
            display: grid;
            grid-template-columns: 50% 25% 25%;
            align-items: center;
            width: 100%;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            padding: 10px 0;
        }
        .car-info {
            grid-column: 1;
            text-align: left;
            padding-right: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .delete-btn-container {
            grid-column: 2;
            text-align: center;
        }
        .delete-btn-container form {
            margin: 0;
            padding: 0;
        }
        .image-type {
            grid-column: 3;
            text-align: right;
            font-weight: normal;
            color: #4b5563;
        }
        .delete-image-btn {
            display: inline-block;
            background-color: #ef4444;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
            border: none;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            transition: background-color 0.2s;
        }
        .delete-image-btn:hover {
            background-color: #dc2626;
        }
        .delete-image-btn:focus {
            outline: 2px solid #f87171;
            outline-offset: 2px;
        }

        /* Mobile styles */
        @media (max-width: 640px) {
            .gslide-title {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto auto;
                gap: 8px;
            }
            .car-info {
                grid-column: 1 / span 2;
                grid-row: 1;
                text-align: center;
                padding-right: 0;
            }
            .delete-btn-container {
                grid-column: 1;
                grid-row: 2;
                text-align: left;
            }
            .image-type {
                grid-column: 2;
                grid-row: 2;
                text-align: right;
            }
        }
    `;
    document.head.appendChild(style);

    // Find all image galleries
    const galleries = document.querySelectorAll('.image-gallery');

    // Process each gallery
    galleries.forEach(function(gallery, galleryIndex) {
        // Get all images in this gallery
        const images = gallery.querySelectorAll('img');

        // Skip if no images found
        if (images.length === 0) return;

        // Create a unique gallery ID
        const galleryId = 'gallery-' + galleryIndex;

        // Process each image
        images.forEach(function(img, index) {
            // Get the parent element (usually an anchor tag)
            const parent = img.parentElement;

            // If parent is an anchor, modify it for GLightbox
            if (parent.tagName === 'A') {
                // Set data attributes for GLightbox
                parent.setAttribute('data-gallery', galleryId);
                parent.setAttribute('data-glightbox', 'image');

                // If there's no href or it's just #, use the image src
                if (!parent.href || parent.href === '#' || parent.href.endsWith('#')) {
                    parent.href = img.src;
                }

                // Get image type from data-caption if available
                const imageType = parent.getAttribute('data-caption');

                // Create a custom title with car info on left and image type on right
                const carInfo = parent.getAttribute('data-title') || '';

                // Get image ID for delete functionality
                const imageId = parent.getAttribute('data-image-id');
                const deleteUrl = parent.getAttribute('data-delete-url');

                // Create the 3-column layout with car info, delete button, and image type
                if (imageType) {
                    let deleteButton = '';
                    if (imageId && deleteUrl) {
                        deleteButton = `
                            <div class="delete-btn-container">
                                <form action="${deleteUrl}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="delete-image-btn">Delete</button>
                                </form>
                            </div>
                        `;
                    }

                    // Format: <div class="car-info">Car info</div> <div class="delete-btn-container">Delete button</div> <div class="image-type">Image Type</div>
                    parent.setAttribute('data-title', `
                        <div class="car-info">${carInfo}</div>
                        ${deleteButton}
                        <div class="image-type">${imageType}</div>
                    `);
                } else if (img.alt) {
                    parent.setAttribute('data-title', img.alt);
                }
            }
            // If parent is not an anchor, wrap the image in an anchor
            else {
                // Create a wrapper anchor
                const wrapper = document.createElement('a');
                wrapper.href = img.src;
                wrapper.setAttribute('data-gallery', galleryId);
                wrapper.setAttribute('data-glightbox', 'image');

                // Add title if available
                if (img.alt) {
                    wrapper.setAttribute('data-title', img.alt);
                }

                // Replace the image with the wrapped version
                parent.replaceChild(wrapper, img);
                wrapper.appendChild(img);
            }
        });

        // Initialize GLightbox for this gallery
        const lightbox = GLightbox({
            selector: '[data-gallery="' + galleryId + '"]',
            touchNavigation: true,
            loop: true,
            autoplayVideos: true,
            moreText: 'View more',
            htmlContent: true  // Enable HTML in captions
        });
    });

    // Handle single images with class 'lightbox-image'
    const singleImages = document.querySelectorAll('.lightbox-image');

    singleImages.forEach(function(img, index) {
        // Get the parent element
        const parent = img.parentElement;

        // If parent is an anchor, modify it for GLightbox
        if (parent.tagName === 'A') {
            // Set data attributes for GLightbox
            parent.setAttribute('data-glightbox', 'image');

            // If there's no href or it's just #, use the image src
            if (!parent.href || parent.href === '#' || parent.href.endsWith('#')) {
                parent.href = img.src;
            }

            // Get image type from data-caption if available
            const imageType = parent.getAttribute('data-caption');

            // Create a custom title with car info on left and image type on right
            const carInfo = parent.getAttribute('data-title') || '';

            // Get image ID for delete functionality
            const imageId = parent.getAttribute('data-image-id');
            const deleteUrl = parent.getAttribute('data-delete-url');

            // Create the 3-column layout with car info, delete button, and image type
            if (imageType) {
                let deleteButton = '';
                if (imageId && deleteUrl) {
                    deleteButton = `
                        <div class="delete-btn-container">
                            <form action="${deleteUrl}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="delete-image-btn">Delete</button>
                            </form>
                        </div>
                    `;
                }

                // Format: <div class="car-info">Car info</div> <div class="delete-btn-container">Delete button</div> <div class="image-type">Image Type</div>
                parent.setAttribute('data-title', `
                    <div class="car-info">${carInfo}</div>
                    ${deleteButton}
                    <div class="image-type">${imageType}</div>
                `);
            } else if (img.alt) {
                parent.setAttribute('data-title', img.alt);
            }
        }
        // If parent is not an anchor, wrap the image in an anchor
        else {
            // Create a wrapper anchor
            const wrapper = document.createElement('a');
            wrapper.href = img.src;
            wrapper.setAttribute('data-glightbox', 'image');

            // Add title if available
            if (img.alt) {
                wrapper.setAttribute('data-title', img.alt);
            }

            // Replace the image with the wrapped version
            parent.replaceChild(wrapper, img);
            wrapper.appendChild(img);
        }
    });

    // Initialize GLightbox for single images
    if (singleImages.length > 0) {
        const singleLightbox = GLightbox({
            selector: '[data-glightbox="image"]',
            touchNavigation: true,
            loop: false,
            autoplayVideos: true,
            moreText: 'View more',
            htmlContent: true  // Enable HTML in captions
        });
    }
});
