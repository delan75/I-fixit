<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\DamagedPart;
use App\Models\Part;
use App\Models\Supplier;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->role === 'admin';

        // Base queries
        $carsQuery = Car::query()->where('status', 'active');
        $suppliersQuery = Supplier::query()->where('status', 'active');
        $partsQuery = Part::query();
        $damagedPartsQuery = DamagedPart::query()->where('status', 'active');

        // Apply user filters for non-admin users
        if (!$isAdmin) {
            $carsQuery->where('created_by', $user->id);
            $suppliersQuery->where('created_by', $user->id);
            $partsQuery->whereHas('car', function ($query) use ($user) {
                $query->where('created_by', $user->id);
            });
            $damagedPartsQuery->whereHas('car', function ($query) use ($user) {
                $query->where('created_by', $user->id);
            });
        }

        // Get counts
        $totalCars = $carsQuery->count();
        $totalSuppliers = $suppliersQuery->count();
        $totalParts = $partsQuery->count();
        $totalDamagedParts = $damagedPartsQuery->count();

        // Get cars by phase - create a clone of the base query
        $carsByPhaseQuery = clone $carsQuery;
        $carsByPhase = $carsByPhaseQuery->select('current_phase', DB::raw('count(*) as total'))
            ->groupBy('current_phase')
            ->pluck('total', 'current_phase')
            ->toArray();

        // Get recent cars with all necessary relationships and fields - create a fresh query
        $recentCarsQuery = Car::query()->where('status', 'active');

        // Apply user filters for non-admin users to the recent cars query
        if (!$isAdmin) {
            $recentCarsQuery->where('created_by', $user->id);
        }

        $recentCars = $recentCarsQuery->with(['creator', 'user'])
            ->select('id', 'make', 'model', 'year', 'current_phase', 'purchase_price', 'purchase_date', 'created_by', 'created_at')
            ->whereNotNull('id')  // Ensure we only get cars with valid IDs
            ->where('id', '>', 0) // Additional check to ensure ID is valid
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get user stats (admin only)
        $userStats = null;
        if ($isAdmin) {
            $userStats = [
                'total' => User::where('status', 'active')->count(),
                'admins' => User::where('status', 'active')->where('role', 'admin')->count(),
                'users' => User::where('status', 'active')->where('role', 'user')->count(),
            ];
        }

        return view('dashboard', compact(
            'totalCars',
            'totalSuppliers',
            'totalParts',
            'totalDamagedParts',
            'carsByPhase',
            'recentCars',
            'userStats',
            'isAdmin'
        ));
    }
}
