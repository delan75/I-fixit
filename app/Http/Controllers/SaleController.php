<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('car')->paginate(10);
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Car $car)
    {
        // Check if the car is in the dealership phase
        if ($car->current_phase !== 'dealership') {
            return redirect()->route('cars.show', $car)
                ->with('error', 'Sale information can only be added for cars in the dealership phase.');
        }

        return view('sales.create', compact('car'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Car $car)
    {
        // Check if the car is in the dealership phase
        if ($car->current_phase !== 'dealership') {
            return redirect()->route('cars.show', $car)
                ->with('error', 'Sale information can only be added for cars in the dealership phase.');
        }

        try {
            // Validate the request
            $rules = [
                'listing_date' => 'required|date',
                'asking_price' => 'required|numeric|min:0',
                'platform' => 'required|string|max:255',
                'selling_price' => 'required|numeric|min:0',
                'sale_date' => 'required|date',
                'buyer_name' => 'nullable|string|max:255',
                'buyer_contact' => 'nullable|string|max:255',
                'commission' => 'nullable|numeric|min:0',
                'fees' => 'nullable|numeric|min:0',
                'notes' => 'nullable|string',
                'mark_as_sold' => 'nullable|boolean',
            ];

            $validated = $request->validate($rules);

            // Create the sale
            $car->sale()->create($validated);

            // If the car is not already marked as sold and the mark_as_sold checkbox is checked,
            // or if selling price and sale date are provided and the car is not already sold,
            // update the car status to sold
            if (($request->has('mark_as_sold') || ($validated['selling_price'] && $validated['sale_date'])) && $car->current_phase != 'sold') {
                $car->update([
                    'current_phase' => 'sold',
                    'sold_date' => $validated['sale_date'],
                ]);
            }

            return redirect()->route('cars.show', $car)
                ->with('success', 'Sale information added successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error adding sale information: ' . $e->getMessage());

            return redirect()->route('cars.show', $car)
                ->with('error', 'An error occurred while adding sale information. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car, Sale $sale)
    {
        // Check if the car is in the dealership or sold phase
        if (!in_array($car->current_phase, ['dealership', 'sold'])) {
            return redirect()->route('cars.show', $car)
                ->with('error', 'Sale information can only be edited for cars in the dealership or sold phase.');
        }

        return view('sales.edit', compact('car', 'sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car, Sale $sale)
    {
        // Check if the car is in the dealership or sold phase
        if (!in_array($car->current_phase, ['dealership', 'sold'])) {
            return redirect()->route('cars.show', $car)
                ->with('error', 'Sale information can only be updated for cars in the dealership or sold phase.');
        }

        try {
            // Validate the request
            $rules = [
                'listing_date' => 'required|date',
                'asking_price' => 'required|numeric|min:0',
                'platform' => 'required|string|max:255',
                'selling_price' => 'required|numeric|min:0',
                'sale_date' => 'required|date',
                'buyer_name' => 'nullable|string|max:255',
                'buyer_contact' => 'nullable|string|max:255',
                'commission' => 'nullable|numeric|min:0',
                'fees' => 'nullable|numeric|min:0',
                'notes' => 'nullable|string',
                'mark_as_sold' => 'nullable|boolean',
            ];

            $validated = $request->validate($rules);

            // Update the sale
            $sale->update($validated);

            // If the car is not already marked as sold and the mark_as_sold checkbox is checked,
            // or if selling price and sale date are provided and the car is not already sold,
            // update the car status to sold
            if (($request->has('mark_as_sold') || ($validated['selling_price'] && $validated['sale_date'])) && $car->current_phase != 'sold') {
                $car->update([
                    'current_phase' => 'sold',
                    'sold_date' => $validated['sale_date'],
                ]);
            }

            return redirect()->route('cars.show', $car)
                ->with('success', 'Sale information updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating sale information: ' . $e->getMessage());

            return redirect()->route('cars.show', $car)
                ->with('error', 'An error occurred while updating sale information. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car, Sale $sale)
    {
        try {
            // Delete the sale
            $sale->delete();

            // Update the car status if it was sold
            if ($car->current_phase == 'sold') {
                $car->update([
                    'current_phase' => 'dealership',
                    'sold_date' => null,
                ]);
            }

            return redirect()->route('cars.show', $car)
                ->with('success', 'Sale information deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting sale information: ' . $e->getMessage());

            return redirect()->route('cars.show', $car)
                ->with('error', 'An error occurred while deleting sale information. Please try again.');
        }
    }
}
