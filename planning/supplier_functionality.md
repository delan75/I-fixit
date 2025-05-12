# I-fixit Supplier Functionality Documentation

## Overview
This document outlines the supplier management functionality in the I-fixit car investment tracking system. The supplier module allows users to manage parts suppliers, track supplier information, and maintain relationships with vendors providing parts for car repairs. The system implements a role-based access control system with soft delete functionality to ensure data integrity and appropriate access levels.

## User Roles and Permissions

### Regular Users
- Can create new suppliers
- Can view suppliers they have created
- Can edit suppliers they have created
- Can soft-delete (deactivate) suppliers they have created
- Cannot see suppliers created by other users
- Cannot see inactive (soft-deleted) suppliers
- Cannot restore inactive suppliers
- Can only see active suppliers in dropdown lists when assigning to parts

### Admin Users
- Can create new suppliers
- Can view all suppliers (created by any user)
- Can edit all suppliers
- Can permanently delete suppliers (if they have no associated parts)
- Can soft-delete (deactivate) suppliers
- Can view inactive (soft-deleted) suppliers
- Can restore inactive suppliers
- Can filter suppliers by status (active/inactive)
- Can see all suppliers in dropdown lists when assigning to parts

### Superusers
- Have all the permissions of admin users
- Intended for system administrators with full access
- Can perform all supplier-related actions regardless of who created the supplier

## Database Structure

### Suppliers Table
- `id`: Primary key
- `name`: Supplier name (required)
- `branch_name`: Branch name (optional)
- `contact_person`: Contact person name (optional)
- `phone`: Contact phone number (optional)
- `email`: Contact email address (optional)
- `address`: Physical address (optional)
- `website`: Company website URL (optional)
- `notes`: Additional notes (optional)
- `status`: Current status ('active' or 'inactive')
- `created_by`: User ID who created the supplier
- `updated_by`: User ID who last updated the supplier
- `created_at`: Timestamp of creation
- `updated_at`: Timestamp of last update
- `deleted_at`: Soft delete timestamp

## Features

### Supplier Listing
- Displays all suppliers the user has permission to view
- Includes filtering by name, branch, contact person, phone, and email
- Includes filtering by creator (for admin/superuser)
- Includes filtering by status (active/inactive) for admin/superuser
- Pagination for large numbers of suppliers

### Supplier Creation
- Form to add new supplier details
- Validation for required fields
- Automatic assignment of created_by and updated_by fields

### Supplier Editing
- Form to update supplier details
- Permission checks to ensure only authorized users can edit
- Tracking of who made the last update

### Supplier Deletion
- Soft deletion for regular users (changes status to 'inactive')
- Option for permanent deletion by admin/superuser (if no associated parts)
- Confirmation dialog to prevent accidental deletion

### Supplier Restoration
- Admin/superuser ability to restore inactive suppliers
- Changes status from 'inactive' back to 'active'

## Implementation Details

### Controller Methods
- `index`: List suppliers with filtering and pagination
- `create`: Show supplier creation form
- `store`: Save new supplier
- `show`: Display supplier details
- `edit`: Show supplier edit form
- `update`: Save supplier changes
- `destroy`: Soft-delete or permanently delete supplier
- `restore`: Restore inactive supplier

### Routes
- `GET /suppliers`: List suppliers
- `GET /suppliers/create`: Show creation form
- `POST /suppliers`: Create new supplier
- `GET /suppliers/{supplier}`: Show supplier details
- `GET /suppliers/{supplier}/edit`: Show edit form
- `PUT /suppliers/{supplier}`: Update supplier
- `DELETE /suppliers/{supplier}`: Delete supplier
- `PUT /suppliers/{supplier}/restore`: Restore inactive supplier

### Policies
- `viewAny`: Determine if user can view supplier listing
- `view`: Determine if user can view specific supplier
- `create`: Determine if user can create suppliers
- `update`: Determine if user can update specific supplier
- `delete`: Determine if user can permanently delete supplier
- `softDelete`: Determine if user can soft-delete supplier
- `restore`: Determine if user can restore supplier

## User Interface

### Supplier Listing Page
- Responsive table with supplier details that adapts to different screen sizes
- Status indicator for admin/superuser (green for active, red for inactive)
- Mobile-friendly action buttons (View, Edit, Delete/Deactivate, Restore)
- Filter and search functionality with collapsible filters on mobile
- Pagination controls optimized for touch interfaces
- Card-based layout on smaller screens for better readability

### Supplier Details Page
- Display all supplier information in a responsive layout
- Show related parts (if any) with horizontal scrolling on mobile
- Action buttons for edit, delete, etc. that adapt to screen size
- Collapsible sections for better organization on mobile devices

### Supplier Form (Create/Edit)
- Responsive input fields for all supplier attributes
- Real-time validation feedback
- Mobile-friendly submit and cancel buttons
- Stacked form layout on smaller screens
- Touch-friendly input elements

## Testing Considerations
- Test permission checks for different user roles
- Test soft deletion and restoration functionality
- Test filtering by status
- Test permanent deletion with and without associated parts
- Test validation rules for required fields
- Test responsive design on various device sizes
- Test touch interactions on mobile devices
- Test accessibility compliance

## Mobile Responsiveness
- Implements Bootstrap 5 responsive grid system
- Uses mobile-first approach for all UI components
- Adapts layout based on screen size (xs, sm, md, lg, xl, xxl)
- Provides touch-friendly interface elements
- Implements collapsible sections for better mobile experience
- Uses appropriate font sizes and spacing for mobile readability
- Ensures buttons and interactive elements have adequate touch targets (minimum 44x44px)

## Accessibility Features
- Proper ARIA attributes for screen readers
- Sufficient color contrast for all UI elements
- Keyboard navigable interface
- Descriptive alt text for icons and images
- Focus indicators for keyboard users

## Future Enhancements
- Supplier performance metrics
- Preferred supplier flagging
- Price comparison between suppliers
- Integration with external supplier databases
- Supplier rating system
- Geolocation integration for nearby suppliers
- QR code generation for quick supplier contact
- Mobile app integration for on-the-go supplier management
