<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DealershipController extends Controller
{
    /**
     * Display the dealership dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';

        // Base query for cars in dealership phase and active status
        $carsQuery = Car::query()
            ->where('status', 'active')
            ->where('current_phase', 'dealership');

        // Apply user filters for non-admin users
        if (!$isAdmin) {
            $carsQuery->where('created_by', $user->id);
        }

        // Get query parameters for filtering
        $make = $request->query('make');
        $model = $request->query('model');
        $year = $request->query('year');
        $daysAtDealership = $request->query('days_at_dealership');

        // Apply filters if provided
        if ($make) {
            $carsQuery->where('make', 'like', "%{$make}%");
        }

        if ($model) {
            $carsQuery->where('model', 'like', "%{$model}%");
        }

        if ($year) {
            $carsQuery->where('year', $year);
        }

        // Filter by days at dealership
        if ($daysAtDealership) {
            $today = now();
            switch ($daysAtDealership) {
                case '30+':
                    $carsQuery->whereDate('dealership_date', '<=', $today->copy()->subDays(30));
                    break;
                case '60+':
                    $carsQuery->whereDate('dealership_date', '<=', $today->copy()->subDays(60));
                    break;
                case '90+':
                    $carsQuery->whereDate('dealership_date', '<=', $today->copy()->subDays(90));
                    break;
            }
        }

        // Get cars with pagination and relationships
        $cars = $carsQuery->with(['sale', 'images'])
            ->orderBy('dealership_date', 'asc')
            ->paginate(10);

        // Calculate days at dealership for each car
        foreach ($cars as $car) {
            $car->days_at_dealership = $car->dealership_date ? $car->dealership_date->diffInDays(now()) : 0;
        }

        // Get unique makes, models, and years for filter dropdowns
        if ($isAdmin) {
            $makes = Car::where('current_phase', 'dealership')
                ->where('status', 'active')
                ->select('make')
                ->distinct()
                ->pluck('make');
            $models = Car::where('current_phase', 'dealership')
                ->where('status', 'active')
                ->select('model')
                ->distinct()
                ->pluck('model');
            $years = Car::where('current_phase', 'dealership')
                ->where('status', 'active')
                ->select('year')
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year');
        } else {
            $makes = Car::where('current_phase', 'dealership')
                ->where('status', 'active')
                ->where('created_by', $user->id)
                ->select('make')
                ->distinct()
                ->pluck('make');
            $models = Car::where('current_phase', 'dealership')
                ->where('status', 'active')
                ->where('created_by', $user->id)
                ->select('model')
                ->distinct()
                ->pluck('model');
            $years = Car::where('current_phase', 'dealership')
                ->where('status', 'active')
                ->where('created_by', $user->id)
                ->select('year')
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year');
        }

        // Get statistics
        $totalCarsAtDealership = $carsQuery->count();

        // Average days at dealership - using a separate query to avoid the GROUP BY issue
        $avgDaysQuery = DB::table('cars')
            ->whereNull('deleted_at')
            ->where('status', 'active')
            ->where('current_phase', 'dealership')
            ->whereNotNull('dealership_date')
            ->selectRaw('AVG(DATEDIFF(CURRENT_DATE, dealership_date)) as avg_days');

        // Apply user filters for non-admin users
        if (!$isAdmin) {
            $avgDaysQuery->where('created_by', $user->id);
        }

        $avgDaysResult = $avgDaysQuery->first();
        $avgDaysAtDealership = $avgDaysResult && $avgDaysResult->avg_days ? round($avgDaysResult->avg_days) : 0;

        // Cars at dealership for more than 30, 60, and 90 days - using separate queries
        $today = now();

        // Base query for over 30 days
        $over30Query = Car::where('status', 'active')
            ->where('current_phase', 'dealership')
            ->whereNotNull('dealership_date')
            ->whereDate('dealership_date', '<=', $today->copy()->subDays(30));

        // Base query for over 60 days
        $over60Query = Car::where('status', 'active')
            ->where('current_phase', 'dealership')
            ->whereNotNull('dealership_date')
            ->whereDate('dealership_date', '<=', $today->copy()->subDays(60));

        // Base query for over 90 days
        $over90Query = Car::where('status', 'active')
            ->where('current_phase', 'dealership')
            ->whereNotNull('dealership_date')
            ->whereDate('dealership_date', '<=', $today->copy()->subDays(90));

        // Apply user filters for non-admin users
        if (!$isAdmin) {
            $over30Query->where('created_by', $user->id);
            $over60Query->where('created_by', $user->id);
            $over90Query->where('created_by', $user->id);
        }

        $carsOver30Days = $over30Query->count();
        $carsOver60Days = $over60Query->count();
        $carsOver90Days = $over90Query->count();

        // Total estimated market value - using a separate query
        $valueQuery = Car::where('status', 'active')
            ->where('current_phase', 'dealership');

        // Apply user filters for non-admin users
        if (!$isAdmin) {
            $valueQuery->where('created_by', $user->id);
        }

        $totalEstimatedValue = $valueQuery->sum('estimated_market_value');

        return view('dealership.index', compact(
            'cars',
            'makes',
            'models',
            'years',
            'make',
            'model',
            'year',
            'daysAtDealership',
            'totalCarsAtDealership',
            'avgDaysAtDealership',
            'carsOver30Days',
            'carsOver60Days',
            'carsOver90Days',
            'totalEstimatedValue'
        ));
    }

    /**
     * Show the form for recording a sale.
     */
    public function recordSale(Car $car)
    {
        // Check if user has permission to view this car
        $this->authorize('view', $car);

        // Check if the car is in the dealership phase and active
        if ($car->current_phase !== 'dealership' || $car->status !== 'active') {
            return redirect()->route('cars.show', $car)
                ->with('error', 'This car is not in the dealership phase or is not active.');
        }

        // Get or create a sale record
        $sale = $car->sale ?? new Sale();

        return view('dealership.record-sale', compact('car', 'sale'));
    }

    /**
     * Store a sale record.
     */
    public function storeSale(Request $request, Car $car)
    {
        // Check if user has permission to update this car
        $this->authorize('update', $car);

        // Check if the car is in the dealership phase and active
        if ($car->current_phase !== 'dealership' || $car->status !== 'active') {
            return redirect()->route('cars.show', $car)
                ->with('error', 'This car is not in the dealership phase or is not active.');
        }

        // Validate the request
        $validated = $request->validate([
            'selling_price' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
            'buyer_name' => 'nullable|string|max:255',
            'buyer_contact' => 'nullable|string|max:255',
            'commission' => 'nullable|numeric|min:0',
            'fees' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'mark_as_sold' => 'nullable|boolean',
        ]);

        // Get or create a sale record
        $sale = $car->sale;
        if (!$sale) {
            // Create a new sale record with default values
            $sale = new Sale([
                'car_id' => $car->id,
                'listing_date' => $car->dealership_date ?? now(),
                'asking_price' => $car->estimated_market_value ?? 0,
                'platform' => 'Dealership',
                'selling_price' => $validated['selling_price'],
                'sale_date' => $validated['sale_date'],
                'buyer_name' => $validated['buyer_name'] ?? null,
                'buyer_contact' => $validated['buyer_contact'] ?? null,
                'commission' => $validated['commission'] ?? 0,
                'fees' => $validated['fees'] ?? 0,
                'notes' => $validated['notes'] ?? null,
            ]);
            $sale->save();
        } else {
            // Update the sale record
            $sale->update([
                'selling_price' => $validated['selling_price'],
                'sale_date' => $validated['sale_date'],
                'buyer_name' => $validated['buyer_name'],
                'buyer_contact' => $validated['buyer_contact'],
                'commission' => $validated['commission'],
                'fees' => $validated['fees'],
                'notes' => $validated['notes'],
            ]);
        }

        // If mark_as_sold is checked, update the car status
        if ($request->has('mark_as_sold')) {
            $car->update([
                'current_phase' => 'sold',
                'sold_date' => $validated['sale_date'],
            ]);
        }

        return redirect()->route('cars.show', $car)
            ->with('success', 'Sale recorded successfully.');
    }

    /**
     * Show the form for updating dealership discount.
     */
    public function editDiscount(Car $car)
    {
        // Check if user has permission to view this car
        $this->authorize('view', $car);

        // Check if the car is in the dealership phase and active
        if ($car->current_phase !== 'dealership' || $car->status !== 'active') {
            return redirect()->route('cars.show', $car)
                ->with('error', 'This car is not in the dealership phase or is not active.');
        }

        return view('dealership.edit-discount', compact('car'));
    }

    /**
     * Update the dealership discount.
     */
    public function updateDiscount(Request $request, Car $car)
    {
        // Check if user has permission to update this car
        $this->authorize('update', $car);

        // Check if the car is in the dealership phase and active
        if ($car->current_phase !== 'dealership' || $car->status !== 'active') {
            return redirect()->route('cars.show', $car)
                ->with('error', 'This car is not in the dealership phase or is not active.');
        }

        // Validate the request
        $validated = $request->validate([
            'dealership_discount' => 'required|numeric|min:0',
            'discount_reason' => 'nullable|string|max:255',
        ]);

        // Update the car with the discount
        $car->update([
            'dealership_discount' => $validated['dealership_discount'],
            'notes' => $car->notes . "\n\nDiscount Reason: " . ($validated['discount_reason'] ?? 'No reason provided'),
        ]);

        return redirect()->route('cars.show', $car)
            ->with('success', 'Dealership discount updated successfully.');
    }
}
