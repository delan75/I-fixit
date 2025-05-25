// Dashboard JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);

    // Opportunity status update
    $('.update-status').on('click', function(e) {
        e.preventDefault();
        
        var opportunityId = $(this).data('opportunity-id');
        var newStatus = $(this).data('status');
        var csrfToken = document.querySelector('[name=csrfmiddlewaretoken]').value;
        
        $.ajax({
            url: '/dashboard/opportunities/' + opportunityId + '/update-status/',
            type: 'POST',
            data: {
                'status': newStatus,
                'csrfmiddlewaretoken': csrfToken
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Update the status badge
                    $('#status-badge-' + opportunityId).removeClass().addClass('badge ' + 'badge-' + newStatus).text(response.status_display);
                    
                    // Show success message
                    var alertHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                    'Status updated successfully!' +
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                    '</div>';
                    $('.messages').html(alertHtml);
                    
                    // Auto-dismiss after 5 seconds
                    setTimeout(function() {
                        $('.alert').alert('close');
                    }, 5000);
                }
            },
            error: function(xhr, status, error) {
                // Show error message
                var alertHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                'Error updating status: ' + error +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                '</div>';
                $('.messages').html(alertHtml);
            }
        });
    });

    // Filter form submission
    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        var currentUrl = window.location.href.split('?')[0];
        
        window.location.href = currentUrl + '?' + formData;
    });

    // Clear filters
    $('#clear-filters').on('click', function(e) {
        e.preventDefault();
        window.location.href = window.location.href.split('?')[0];
    });
});
