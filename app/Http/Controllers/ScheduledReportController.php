<?php

namespace App\Http\Controllers;

use App\Models\ReportType;
use App\Models\ScheduledReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduledReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get user's scheduled reports
        $scheduledReports = Auth::user()->hasAdminAccess()
            ? ScheduledReport::with('reportType', 'user')->latest()->paginate(10)
            : ScheduledReport::where('user_id', Auth::id())->with('reportType')->latest()->paginate(10);

        return view('scheduled-reports.index', compact('scheduledReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all report types
        $reportTypes = ReportType::active()->get();

        // Get frequency options
        $frequencies = [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
        ];

        // Get days of week for weekly reports
        $daysOfWeek = [
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
        ];

        // Get days of month for monthly reports
        $daysOfMonth = array_combine(range(1, 28), range(1, 28));

        // Get export format options
        $exportFormats = [
            'pdf' => 'PDF',
            'xlsx' => 'Excel',
            'csv' => 'CSV',
        ];

        return view('scheduled-reports.create', compact('reportTypes', 'frequencies', 'daysOfWeek', 'daysOfMonth', 'exportFormats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'report_type_id' => 'required|exists:report_types,id',
            'frequency' => 'required|in:daily,weekly,monthly',
            'time' => 'required|date_format:H:i',
            'day_of_week' => 'required_if:frequency,weekly|nullable|string',
            'day_of_month' => 'required_if:frequency,monthly|nullable|integer|min:1|max:28',
            'recipients' => 'nullable|string',
            'export_format' => 'required|in:pdf,xlsx,csv',
            'is_active' => 'boolean',

            // Report filters
            'date_range' => 'required|string',
            'start_date' => 'required_if:date_range,custom|nullable|date',
            'end_date' => 'required_if:date_range,custom|nullable|date|after_or_equal:start_date',
            'make' => 'nullable|string',
            'model' => 'nullable|string',
            'year' => 'nullable|integer',
            'phase' => 'nullable|string|in:bidding,fixing,dealership,sold',
            'selected_cars' => 'nullable|array',
            'selected_cars.*' => 'exists:cars,id',
            'selected_user_id' => 'nullable|exists:users,id',
        ]);

        // Prepare filters
        $filters = [
            'date_range' => $validated['date_range'],
            'make' => $validated['make'] ?? null,
            'model' => $validated['model'] ?? null,
            'year' => $validated['year'] ?? null,
            'phase' => $validated['phase'] ?? null,
        ];

        // Add custom date range if selected
        if ($validated['date_range'] === 'custom') {
            $filters['start_date'] = $validated['start_date'];
            $filters['end_date'] = $validated['end_date'];
        }

        // Add selected cars if any
        if (isset($validated['selected_cars'])) {
            $filters['selected_cars'] = $validated['selected_cars'];
        }

        // Add selected user if admin/superuser
        if (Auth::user()->hasAdminAccess() && isset($validated['selected_user_id'])) {
            $filters['selected_user_id'] = $validated['selected_user_id'];
        }

        // Create the scheduled report
        $scheduledReport = new ScheduledReport();
        $scheduledReport->name = $validated['name'];
        $scheduledReport->report_type_id = $validated['report_type_id'];
        $scheduledReport->user_id = Auth::id();
        $scheduledReport->frequency = $validated['frequency'];
        $scheduledReport->time = $validated['time'];
        $scheduledReport->day_of_week = $validated['frequency'] === 'weekly' ? $validated['day_of_week'] : null;
        $scheduledReport->day_of_month = $validated['frequency'] === 'monthly' ? $validated['day_of_month'] : null;
        $scheduledReport->recipients = $validated['recipients'];
        $scheduledReport->export_format = $validated['export_format'];
        $scheduledReport->is_active = $request->has('is_active');
        $scheduledReport->filters = $filters;

        // Calculate the next run time
        $scheduledReport->next_run_at = $scheduledReport->calculateNextRunTime();

        $scheduledReport->save();

        return redirect()->route('scheduled-reports.index')
            ->with('success', 'Scheduled report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ScheduledReport $scheduledReport)
    {
        // Check if user has permission to view this scheduled report
        if ($scheduledReport->user_id !== Auth::id() && !Auth::user()->hasAdminAccess()) {
            abort(403, 'Unauthorized action.');
        }

        return view('scheduled-reports.show', compact('scheduledReport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScheduledReport $scheduledReport)
    {
        // Check if user has permission to edit this scheduled report
        if ($scheduledReport->user_id !== Auth::id() && !Auth::user()->hasAdminAccess()) {
            abort(403, 'Unauthorized action.');
        }

        // Get all report types
        $reportTypes = ReportType::active()->get();

        // Get frequency options
        $frequencies = [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
        ];

        // Get days of week for weekly reports
        $daysOfWeek = [
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
        ];

        // Get days of month for monthly reports
        $daysOfMonth = array_combine(range(1, 28), range(1, 28));

        // Get export format options
        $exportFormats = [
            'pdf' => 'PDF',
            'xlsx' => 'Excel',
            'csv' => 'CSV',
        ];

        return view('scheduled-reports.edit', compact('scheduledReport', 'reportTypes', 'frequencies', 'daysOfWeek', 'daysOfMonth', 'exportFormats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScheduledReport $scheduledReport)
    {
        // Check if user has permission to update this scheduled report
        if ($scheduledReport->user_id !== Auth::id() && !Auth::user()->hasAdminAccess()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'report_type_id' => 'required|exists:report_types,id',
            'frequency' => 'required|in:daily,weekly,monthly',
            'time' => 'required|date_format:H:i',
            'day_of_week' => 'required_if:frequency,weekly|nullable|string',
            'day_of_month' => 'required_if:frequency,monthly|nullable|integer|min:1|max:28',
            'recipients' => 'nullable|string',
            'export_format' => 'required|in:pdf,xlsx,csv',
            'is_active' => 'boolean',

            // Report filters
            'date_range' => 'required|string',
            'start_date' => 'required_if:date_range,custom|nullable|date',
            'end_date' => 'required_if:date_range,custom|nullable|date|after_or_equal:start_date',
            'make' => 'nullable|string',
            'model' => 'nullable|string',
            'year' => 'nullable|integer',
            'phase' => 'nullable|string|in:bidding,fixing,dealership,sold',
            'selected_cars' => 'nullable|array',
            'selected_cars.*' => 'exists:cars,id',
            'selected_user_id' => 'nullable|exists:users,id',
        ]);

        // Prepare filters
        $filters = [
            'date_range' => $validated['date_range'],
            'make' => $validated['make'] ?? null,
            'model' => $validated['model'] ?? null,
            'year' => $validated['year'] ?? null,
            'phase' => $validated['phase'] ?? null,
        ];

        // Add custom date range if selected
        if ($validated['date_range'] === 'custom') {
            $filters['start_date'] = $validated['start_date'];
            $filters['end_date'] = $validated['end_date'];
        }

        // Add selected cars if any
        if (isset($validated['selected_cars'])) {
            $filters['selected_cars'] = $validated['selected_cars'];
        }

        // Add selected user if admin/superuser
        if (Auth::user()->hasAdminAccess() && isset($validated['selected_user_id'])) {
            $filters['selected_user_id'] = $validated['selected_user_id'];
        }

        // Update the scheduled report
        $scheduledReport->name = $validated['name'];
        $scheduledReport->report_type_id = $validated['report_type_id'];
        $scheduledReport->frequency = $validated['frequency'];
        $scheduledReport->time = $validated['time'];
        $scheduledReport->day_of_week = $validated['frequency'] === 'weekly' ? $validated['day_of_week'] : null;
        $scheduledReport->day_of_month = $validated['frequency'] === 'monthly' ? $validated['day_of_month'] : null;
        $scheduledReport->recipients = $validated['recipients'];
        $scheduledReport->export_format = $validated['export_format'];
        $scheduledReport->is_active = $request->has('is_active');
        $scheduledReport->filters = $filters;

        // Recalculate the next run time
        $scheduledReport->next_run_at = $scheduledReport->calculateNextRunTime();

        $scheduledReport->save();

        return redirect()->route('scheduled-reports.index')
            ->with('success', 'Scheduled report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduledReport $scheduledReport)
    {
        // Check if user has permission to delete this scheduled report
        if ($scheduledReport->user_id !== Auth::id() && !Auth::user()->hasAdminAccess()) {
            abort(403, 'Unauthorized action.');
        }

        $scheduledReport->delete();

        return redirect()->route('scheduled-reports.index')
            ->with('success', 'Scheduled report deleted successfully.');
    }

    /**
     * Toggle the active status of the scheduled report.
     */
    public function toggleActive(ScheduledReport $scheduledReport)
    {
        // Check if user has permission to update this scheduled report
        if ($scheduledReport->user_id !== Auth::id() && !Auth::user()->hasAdminAccess()) {
            abort(403, 'Unauthorized action.');
        }

        $scheduledReport->is_active = !$scheduledReport->is_active;

        // If activating, recalculate the next run time
        if ($scheduledReport->is_active) {
            $scheduledReport->next_run_at = $scheduledReport->calculateNextRunTime();
        }

        $scheduledReport->save();

        $status = $scheduledReport->is_active ? 'activated' : 'deactivated';

        return redirect()->route('scheduled-reports.index')
            ->with('success', "Scheduled report {$status} successfully.");
    }
}
