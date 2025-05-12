<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use App\Models\Car;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserPreferenceController extends Controller
{
    /**
     * The activity log service instance.
     *
     * @var \App\Services\ActivityLogService
     */
    protected $activityLogService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\ActivityLogService $activityLogService
     * @return void
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->middleware('auth');
        $this->activityLogService = $activityLogService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Redirect to edit page for the current user
        return redirect()->route('preferences.edit');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used - preferences are created automatically
        return redirect()->route('preferences.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Not used - preferences are created automatically
        return redirect()->route('preferences.edit');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used - redirect to edit page
        return redirect()->route('preferences.edit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();

        // Get or create user preferences
        $preferences = $user->preferences ?? UserPreference::create([
            'user_id' => $user->id,
        ]);

        // Get car makes for dropdown
        $makes = Car::select('make')->distinct()->orderBy('make')->pluck('make')->filter();

        return view('preferences.edit', compact('preferences', 'makes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $validator = Validator::make($request->all(), [
            'preferred_makes' => 'nullable|array',
            'preferred_models' => 'nullable|array',
            'min_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'max_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'min_profit' => 'nullable|numeric|min:0',
            'max_investment' => 'nullable|numeric|min:0',
            'notification_email' => 'boolean',
            'notification_sms' => 'boolean',
            'notification_app' => 'boolean',
            'notification_repair_phase' => 'boolean',
            'notification_dealership_phase' => 'boolean',
            'notification_budget_exceeded' => 'boolean',
            'notification_opportunity' => 'boolean',
            'repair_phase_days_threshold' => 'integer|min:1|max:365',
            'dealership_phase_days_threshold' => 'integer|min:1|max:365',
            'budget_exceeded_percentage' => 'integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get or create user preferences
        $preferences = $user->preferences ?? new UserPreference(['user_id' => $user->id]);

        // Update preferences
        $preferences->fill([
            'preferred_makes' => $request->preferred_makes,
            'preferred_models' => $request->preferred_models,
            'min_year' => $request->min_year,
            'max_year' => $request->max_year,
            'min_profit' => $request->min_profit,
            'max_investment' => $request->max_investment,
            'notification_email' => $request->has('notification_email'),
            'notification_sms' => $request->has('notification_sms'),
            'notification_app' => $request->has('notification_app'),
            'notification_repair_phase' => $request->has('notification_repair_phase'),
            'notification_dealership_phase' => $request->has('notification_dealership_phase'),
            'notification_budget_exceeded' => $request->has('notification_budget_exceeded'),
            'notification_opportunity' => $request->has('notification_opportunity'),
            'repair_phase_days_threshold' => $request->repair_phase_days_threshold,
            'dealership_phase_days_threshold' => $request->dealership_phase_days_threshold,
            'budget_exceeded_percentage' => $request->budget_exceeded_percentage,
        ]);

        $preferences->save();

        // Log the activity
        $this->activityLogService->log(
            'updated',
            'user_preferences',
            $preferences->id,
            'User preferences updated'
        );

        return redirect()->route('preferences.edit')
            ->with('success', 'Notification preferences updated successfully.');
    }

    /**
     * Get car models for a specific make.
     */
    public function getModels(Request $request)
    {
        $make = $request->input('make');

        if (!$make) {
            return response()->json([]);
        }

        $models = Car::where('make', $make)
            ->select('model')
            ->distinct()
            ->orderBy('model')
            ->pluck('model')
            ->filter()
            ->values();

        return response()->json($models);
    }
}
