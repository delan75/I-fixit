<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestNotificationController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarImageController;
use App\Http\Controllers\DamagedPartController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\PaintingController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPreferenceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Car routes
    Route::resource('cars', CarController::class);

    // Car Images routes
    Route::get('cars/{car}/images/create', [CarImageController::class, 'create'])->name('car_images.create');
    Route::post('cars/{car}/images', [CarImageController::class, 'store'])->name('car_images.store');
    Route::delete('cars/{car}/images/{image}', [CarImageController::class, 'destroy'])->name('car_images.destroy');

    // Report routes
    Route::resource('reports', ReportController::class);
    Route::get('reports/{report}/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::get('reports/{report}/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');

    // Scheduled Report routes
    Route::resource('scheduled-reports', ScheduledReportController::class);
    Route::put('scheduled-reports/{scheduledReport}/toggle-active', [ScheduledReportController::class, 'toggleActive'])->name('scheduled-reports.toggle-active');

    // Notification routes
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-as-read');
    Route::get('notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    Route::get('notifications/recent', [NotificationController::class, 'getRecent'])->name('notifications.recent');
    Route::get('notifications/test', [TestNotificationController::class, 'sendTestNotification'])->name('notifications.test');

    // User Preferences routes
    Route::get('preferences', [UserPreferenceController::class, 'edit'])->name('preferences.edit');
    Route::put('preferences', [UserPreferenceController::class, 'update'])->name('preferences.update');
    Route::get('preferences/models', [UserPreferenceController::class, 'getModels'])->name('preferences.get-models');

    // Damaged Parts routes
    Route::get('cars/{car}/damaged-parts/create', [DamagedPartController::class, 'create'])->name('damaged_parts.create');
    Route::post('cars/{car}/damaged-parts', [DamagedPartController::class, 'store'])->name('damaged_parts.store');
    Route::get('cars/{car}/damaged-parts/{damagedPart}/edit', [DamagedPartController::class, 'edit'])->name('damaged_parts.edit');
    Route::put('cars/{car}/damaged-parts/{damagedPart}', [DamagedPartController::class, 'update'])->name('damaged_parts.update');
    Route::delete('cars/{car}/damaged-parts/{damagedPart}', [DamagedPartController::class, 'destroy'])->name('damaged_parts.destroy');
    Route::delete('cars/{car}/damaged-parts/{damagedPart}/images/{image}', [DamagedPartController::class, 'destroyImage'])->name('damaged_part_images.destroy');

    // Supplier routes
    Route::resource('suppliers', SupplierController::class);
    Route::put('suppliers/{supplier}/restore', [SupplierController::class, 'restore'])->name('suppliers.restore');

    // Parts routes
    Route::get('cars/{car}/parts/create', [PartController::class, 'create'])->name('parts.create');
    Route::post('cars/{car}/parts', [PartController::class, 'store'])->name('parts.store');
    Route::get('cars/{car}/parts/{part}/edit', [PartController::class, 'edit'])->name('parts.edit');
    Route::put('cars/{car}/parts/{part}', [PartController::class, 'update'])->name('parts.update');
    Route::delete('cars/{car}/parts/{part}', [PartController::class, 'destroy'])->name('parts.destroy');

    // Labor routes
    Route::get('cars/{car}/labor/create', [LaborController::class, 'create'])->name('labor.create');
    Route::post('cars/{car}/labor', [LaborController::class, 'store'])->name('labor.store');
    Route::get('cars/{car}/labor/{labor}/edit', [LaborController::class, 'edit'])->name('labor.edit');
    Route::put('cars/{car}/labor/{labor}', [LaborController::class, 'update'])->name('labor.update');
    Route::delete('cars/{car}/labor/{labor}', [LaborController::class, 'destroy'])->name('labor.destroy');

    // Painting routes
    Route::get('cars/{car}/painting/create', [PaintingController::class, 'create'])->name('painting.create');
    Route::post('cars/{car}/painting', [PaintingController::class, 'store'])->name('painting.store');
    Route::get('cars/{car}/painting/{painting}/edit', [PaintingController::class, 'edit'])->name('painting.edit');
    Route::put('cars/{car}/painting/{painting}', [PaintingController::class, 'update'])->name('painting.update');
    Route::delete('cars/{car}/painting/{painting}', [PaintingController::class, 'destroy'])->name('painting.destroy');

    // Sale routes
    Route::get('cars/{car}/sale/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('cars/{car}/sale', [SaleController::class, 'store'])->name('sales.store');
    Route::get('cars/{car}/sale/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
    Route::put('cars/{car}/sale/{sale}', [SaleController::class, 'update'])->name('sales.update');
    Route::delete('cars/{car}/sale/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');

    // Dealership routes
    Route::get('dealership', [DealershipController::class, 'index'])->name('dealership.index');
    Route::get('dealership/cars/{car}/record-sale', [DealershipController::class, 'recordSale'])->name('dealership.record-sale');
    Route::post('dealership/cars/{car}/record-sale', [DealershipController::class, 'storeSale'])->name('dealership.store-sale');
    Route::get('dealership/cars/{car}/edit-discount', [DealershipController::class, 'editDiscount'])->name('dealership.edit-discount');
    Route::post('dealership/cars/{car}/update-discount', [DealershipController::class, 'updateDiscount'])->name('dealership.update-discount');

    // User management routes (admin only)
    Route::middleware(['admin', 'sensitive:10,1'])->group(function () {
        // Apply rate limiting to sensitive user operations
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::put('users/{user}/soft-delete', [UserController::class, 'softDelete'])->name('users.soft-delete');
        Route::put('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');

        // Less sensitive user operations
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

        // Audit logs routes
        Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
        Route::get('audit-logs/{auditLog}', [AuditLogController::class, 'show'])->name('audit-logs.show');

        // Contact messages admin routes
        Route::get('contact-messages', [ContactController::class, 'adminIndex'])->name('contact.admin.index');
        Route::get('contact-messages/{contact}', [ContactController::class, 'adminShow'])->name('contact.admin.show');
        Route::delete('contact-messages/{contact}', [ContactController::class, 'adminDestroy'])->name('contact.admin.destroy');
    });

    // Superuser-only routes
    Route::middleware(['superuser', 'sensitive:10,1'])->group(function () {
        // Activity logs routes
        Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::get('activity-logs/{activityLog}', [ActivityLogController::class, 'show'])->name('activity-logs.show');
        Route::delete('activity-logs/clear', [ActivityLogController::class, 'clearAll'])->name('activity-logs.clear');
    });
});

require __DIR__.'/auth.php';
