<?php

namespace App\Http\Middleware;

use App\Models\Car;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PhaseTransitionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the car ID from the route parameters
        $carId = $request->route('car');
        
        // If there's no car ID, just proceed
        if (!$carId) {
            return $next($request);
        }
        
        // If the car ID is already a Car model instance, use it
        if ($carId instanceof Car) {
            $car = $carId;
        } else {
            // Otherwise, try to find the car
            try {
                $car = Car::findOrFail($carId);
            } catch (\Exception $e) {
                Log::error('Error finding car: ' . $e->getMessage());
                return redirect()->route('cars.index')
                    ->with('error', 'Car not found.');
            }
        }
        
        // Check if the request is trying to update a car's phase
        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('patch')) {
            // If the request has a current_phase field, check if it's a valid transition
            if ($request->has('current_phase') && $request->input('current_phase') !== $car->current_phase) {
                $newPhase = $request->input('current_phase');
                $currentPhase = $car->current_phase;
                
                // Define valid phase transitions
                $validTransitions = [
                    'bidding' => ['fixing'],
                    'fixing' => ['dealership'],
                    'dealership' => ['sold'],
                    'sold' => []
                ];
                
                // Check if the transition is valid
                if (!in_array($newPhase, $validTransitions[$currentPhase])) {
                    Log::warning("Invalid phase transition attempted: {$currentPhase} to {$newPhase} for car ID {$car->id}");
                    return redirect()->route('cars.show', $car)
                        ->with('error', "Cannot transition from {$currentPhase} to {$newPhase}. Invalid phase transition.");
                }
                
                // Check if the car has the required data for the new phase
                if ($newPhase === 'fixing' && !$car->purchase_date) {
                    return redirect()->route('cars.show', $car)
                        ->with('error', 'Cannot move to fixing phase without a purchase date.');
                }
                
                if ($newPhase === 'dealership') {
                    // Check if the car has parts added
                    if ($car->parts()->count() === 0) {
                        return redirect()->route('cars.show', $car)
                            ->with('error', 'Cannot move to dealership phase without adding parts.');
                    }
                }
                
                if ($newPhase === 'sold') {
                    // Check if the car has sale information
                    if (!$car->sale) {
                        return redirect()->route('cars.show', $car)
                            ->with('error', 'Cannot move to sold phase without adding sale information.');
                    }
                }
            }
        }
        
        // If we're trying to add sale information, check if the car is in the dealership phase
        if ($request->is('*/sales/create') || $request->is('*/sales')) {
            if ($car->current_phase !== 'dealership') {
                return redirect()->route('cars.show', $car)
                    ->with('error', 'Sale information can only be added for cars in the dealership phase.');
            }
        }
        
        // If we're trying to add parts, check if the car is in the fixing phase
        if ($request->is('*/parts/create') || $request->is('*/parts')) {
            if ($car->current_phase !== 'fixing') {
                return redirect()->route('cars.show', $car)
                    ->with('error', 'Parts can only be added for cars in the fixing phase.');
            }
        }
        
        return $next($request);
    }
}
