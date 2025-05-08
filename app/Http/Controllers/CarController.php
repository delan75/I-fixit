<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get query parameters for filtering
        $phase = $request->query('phase');
        $make = $request->query('make');
        $model = $request->query('model');
        $year = $request->query('year');

        // Start with a base query
        $query = Car::query();

        // Apply authorization filter - admin sees all, users see only their own
        $user = Auth::user();
        if ($user->role !== 'admin') {
            $query->where('created_by', $user->id);
        }

        // Only show active records
        $query->where('status', 'active');

        // Apply filters if provided
        if ($phase) {
            $query->where('current_phase', $phase);
        }

        if ($make) {
            $query->where('make', 'like', "%{$make}%");
        }

        if ($model) {
            $query->where('model', 'like', "%{$model}%");
        }

        if ($year) {
            $query->where('year', $year);
        }

        // Get the cars with pagination
        $cars = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get unique makes, models, and years for filter dropdowns
        // For regular users, only show their own data for filters
        if ($user->role === 'admin') {
            $makes = Car::select('make')->distinct()->pluck('make');
            $models = Car::select('model')->distinct()->pluck('model');
            $years = Car::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        } else {
            $makes = Car::where('created_by', $user->id)->select('make')->distinct()->pluck('make');
            $models = Car::where('created_by', $user->id)->select('model')->distinct()->pluck('model');
            $years = Car::where('created_by', $user->id)->select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        }

        return view('cars.index', compact('cars', 'makes', 'models', 'years', 'phase', 'make', 'model', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $step = $request->query('step', 1);
        $car_id = $request->query('car_id');

        // If car_id is provided, load the car
        $car = null;
        if ($car_id) {
            $car = Car::findOrFail($car_id);
            // If step is not provided but car has a form_step, use that
            if (!$request->has('step') && $car->form_step) {
                $step = $car->form_step;
            }
        }

        return view('cars.create', compact('step', 'car'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $step = $request->input('step', 1);
        $car_id = $request->input('car_id');
        $action = $request->input('action', 'next');

        // If car_id is provided, load the car for updating
        if ($car_id) {
            $car = Car::findOrFail($car_id);

            // Check if user has permission to update this car
            $this->authorize('update', $car);
        }

        // Validate based on the current step
        $validated = $this->validateStep($request, $step);

        // Ensure purchase_date is set to current date if not provided
        if (!isset($validated['purchase_date'])) {
            $validated['purchase_date'] = now()->toDateString();
        } else {
            // Make sure purchase_date is in the correct format
            $validated['purchase_date'] = date('Y-m-d', strtotime($validated['purchase_date']));
        }

        // Add user_id and created_by to the validated data for new cars
        if (!isset($car)) {
            $validated['user_id'] = Auth::id();
            $validated['created_by'] = Auth::id();
            $validated['updated_by'] = Auth::id();
            $validated['form_step'] = $step;
            $validated['status'] = 'active';

            // Create the car
            $car = Car::create($validated);
        } else {
            // Add updated_by to the validated data
            $validated['updated_by'] = Auth::id();

            // Update the car with the validated data
            $car->update($validated);

            // Update the form step based on the action
            if ($action == 'next') {
                $car->form_step = $step + 1;
            } elseif ($action == 'back' && $step > 1) {
                $car->form_step = $step - 1;
            } elseif ($action == 'save') {
                // Keep the same step when just saving
                $car->form_step = $step;
            }

            // Mark as completed if we've gone through all steps
            if ($action == 'next' && $step >= 4) {
                $car->form_completed = true;
            }

            $car->save();
        }

        // Handle image uploads if any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('car_images', 'public');

                $car->images()->create([
                    'image_path' => $path,
                    'image_type' => $request->input('image_type', 'before_repair'),
                    'description' => $request->input('image_description'),
                ]);
            }
        }

        // Determine the next action
        if ($action == 'save') {
            // Mark the form as completed if we're on the last step
            if ($step == 4) {
                $car->form_completed = true;
                $car->save();
            }

            return redirect()->route('cars.show', $car)
                ->with('success', 'Car information saved successfully.');
        } elseif ($action == 'next') {
            // If we're on the last step, mark the form as completed
            if ($step == 4) {
                $car->form_completed = true;
                $car->save();

                return redirect()->route('cars.show', $car)
                    ->with('success', 'Car created successfully.');
            }

            // Otherwise, go to the next step
            return redirect()->route('cars.create', ['step' => $step + 1, 'car_id' => $car->id]);
        } elseif ($action == 'back' && $step > 1) {
            // Go back to the previous step
            return redirect()->route('cars.create', ['step' => $step - 1, 'car_id' => $car->id]);
        }

        // Default fallback
        return redirect()->route('cars.create', ['step' => $step, 'car_id' => $car->id]);
    }

    /**
     * Validate the form data based on the current step.
     */
    private function validateStep(Request $request, int $step)
    {
        $rules = [];

        // Step 1: Basic Information
        if ($step == 1) {
            $rules = [
                'make' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'variant' => 'nullable|string|max:255',
                'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'vin' => 'nullable|string|max:255',
                'registration_number' => 'nullable|string|max:255',
                'color' => 'nullable|string|max:255',
                'interior_type' => 'nullable|string|max:255',
                'body_type' => 'required|string|max:255',
                'engine_size' => 'nullable|string|max:255',
                'fuel_type' => 'required|string|max:255',
                'transmission' => 'required|string|max:255',
                'mileage' => 'required|integer|min:0',
                'features' => 'nullable|array',
            ];
        }
        // Step 2: Purchase Information
        elseif ($step == 2) {
            $rules = [
                'purchase_date' => 'nullable|date', // Updated to allow null values
                'purchase_price' => 'required|numeric|min:0',
                'auction_house' => 'nullable|string|max:255',
                'auction_branch' => 'nullable|string|max:255',
                'auction_lot_number' => 'nullable|string|max:255',
                'transportation_cost' => 'nullable|numeric|min:0',
                'registration_papers_cost' => 'nullable|numeric|min:0',
                'number_plates_cost' => 'nullable|numeric|min:0',
                'other_costs' => 'nullable|numeric|min:0',
                'other_costs_description' => 'nullable|string',
            ];
        }
        // Step 3: Damage Information
        elseif ($step == 3) {
            $rules = [
                'damage_description' => 'nullable|string', // Changed to nullable
                'damage_severity' => 'required|in:light,moderate,severe',
                'operational_status' => 'required|in:running,non-running',
                'vehicle_code' => 'required|in:Code 2,Code 3,Code 4',
            ];
        }
        // Step 4: Status & Projections
        elseif ($step == 4) {
            $rules = [
                'current_phase' => 'required|in:bidding,fixing,dealership,sold',
                'repair_start_date' => 'nullable|date',
                'repair_end_date' => 'nullable|date',
                'dealership_date' => 'nullable|date',
                'sold_date' => 'nullable|date',
                'estimated_repair_cost' => 'nullable|numeric|min:0',
                'estimated_market_value' => 'nullable|numeric|min:0',
                'dealership_discount' => 'nullable|numeric|min:0',
                'notes' => 'nullable|string',
            ];
        }

        return $request->validate($rules);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        // Check if user has permission to view this car
        $this->authorize('view', $car);

        // Load relationships
        $car->load([
            'images',
            'damagedParts',
            'parts.supplier',
            'laborEntries',
            'paintingEntries',
            'sale',
            'documents'
        ]);

        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        // Check if user has permission to edit this car
        $this->authorize('update', $car);

        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        // Check if user has permission to update this car
        $this->authorize('update', $car);

        $step = $request->input('step');

        // If step is provided, we're updating a specific step of the form
        if ($step) {
            // Validate based on the current step
            $validated = $this->validateStep($request, $step);

            // Ensure purchase_date is set to current date if not provided
            if (!isset($validated['purchase_date'])) {
                $validated['purchase_date'] = now()->toDateString(); // Set to current date if not provided
            } else {
                // Make sure purchase_date is in the correct format
                $validated['purchase_date'] = date('Y-m-d', strtotime($validated['purchase_date']));
            }

            // Add updated_by to the validated data
            $validated['updated_by'] = Auth::id();

            // Update the car with the validated data
            $car->update($validated);

            // Handle image uploads if any
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('car_images', 'public');

                    $car->images()->create([
                        'image_path' => $path,
                        'image_type' => $request->input('image_type', 'before_repair'),
                        'description' => $request->input('image_description'),
                    ]);
                }
            }

            return redirect()->route('cars.show', $car)
                ->with('success', 'Car information updated successfully.');
        }

        // Otherwise, we're doing a full update
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'variant' => 'nullable|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'vin' => 'nullable|string|max:255',
            'registration_number' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'interior_type' => 'nullable|string|max:255',
            'body_type' => 'required|string|max:255',
            'engine_size' => 'nullable|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'mileage' => 'required|integer|min:0',
            'features' => 'nullable|array',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric|min:0',
            'auction_house' => 'nullable|string|max:255',
            'auction_branch' => 'nullable|string|max:255',
            'auction_lot_number' => 'nullable|string|max:255',
            'damage_description' => 'nullable|string',
            'damage_severity' => 'required|in:light,moderate,severe',
            'operational_status' => 'required|in:running,non-running',
            'vehicle_code' => 'required|in:Code 2,Code 3,Code 4',
            'current_phase' => 'required|in:bidding,fixing,dealership,sold',
            'repair_start_date' => 'nullable|date',
            'repair_end_date' => 'nullable|date',
            'dealership_date' => 'nullable|date',
            'sold_date' => 'nullable|date',
            'transportation_cost' => 'nullable|numeric|min:0',
            'registration_papers_cost' => 'nullable|numeric|min:0',
            'number_plates_cost' => 'nullable|numeric|min:0',
            'dealership_discount' => 'nullable|numeric|min:0',
            'other_costs' => 'nullable|numeric|min:0',
            'other_costs_description' => 'nullable|string',
            'estimated_repair_cost' => 'nullable|numeric|min:0',
            'estimated_market_value' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Ensure purchase_date is set to current date if not provided
        if (!isset($validated['purchase_date'])) {
            $validated['purchase_date'] = now()->toDateString(); // Set to current date if not provided
        } else {
            // Make sure purchase_date is in the correct format
            $validated['purchase_date'] = date('Y-m-d', strtotime($validated['purchase_date']));
        }

        // Add updated_by to the validated data
        $validated['updated_by'] = Auth::id();

        // Update the car
        $car->update($validated);

        // Handle image uploads if any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('car_images', 'public');

                $car->images()->create([
                    'image_path' => $path,
                    'image_type' => $request->input('image_type', 'before_repair'),
                    'description' => $request->input('image_description'),
                ]);
            }
        }

        return redirect()->route('cars.show', $car)
            ->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        // Check if user has permission to delete this car
        if (Auth::user()->role === 'admin') {
            // Admin can permanently delete
            $this->authorize('delete', $car);
            $car->delete();
            $message = 'Car permanently deleted successfully.';
        } else {
            // Regular users can only soft delete (mark as inactive)
            $this->authorize('softDelete', $car);
            $car->status = 'inactive';
            $car->updated_by = Auth::id();
            $car->save();
            $message = 'Car deleted successfully.';
        }

        return redirect()->route('cars.index')
            ->with('success', $message);
    }
}
