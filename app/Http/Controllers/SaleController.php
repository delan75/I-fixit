<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Sale;
use Illuminate\Http\Request;

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
        return view('sales.create', compact('car'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Car $car)
    {
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
        $sale = $car->sale()->create($validated);

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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car, Sale $sale)
    {
        return view('sales.edit', compact('car', 'sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car, Sale $sale)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car, Sale $sale)
    {
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
    }
}
