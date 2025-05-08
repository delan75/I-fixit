<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Only superusers can view activity logs
        Gate::authorize('view-activity-logs');

        $query = ActivityLog::with('user')->latest();

        // Filter by user if provided
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by activity type if provided
        if ($request->has('activity_type') && $request->activity_type) {
            $query->where('activity_type', $request->activity_type);
        }

        // Filter by model type if provided
        if ($request->has('model_type') && $request->model_type) {
            $query->where('model_type', $request->model_type);
        }

        // Filter by date range if provided
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activityLogs = $query->paginate(20);

        // Get unique values for filters
        $users = User::select('id', 'name')
            ->whereIn('id', ActivityLog::select('user_id')->distinct()->whereNotNull('user_id')->pluck('user_id'))
            ->get();

        $activityTypes = ActivityLog::select('activity_type')->distinct()->pluck('activity_type');
        $modelTypes = ActivityLog::select('model_type')->distinct()->whereNotNull('model_type')->pluck('model_type');

        return view('activity-logs.index', compact('activityLogs', 'users', 'activityTypes', 'modelTypes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivityLog $activityLog)
    {
        // Only superusers can view activity logs
        Gate::authorize('view-activity-logs');

        return view('activity-logs.show', compact('activityLog'));
    }

    /**
     * Clear all activity logs.
     */
    public function clearAll()
    {
        // Only superusers can clear activity logs
        Gate::authorize('superuser-action');

        ActivityLog::truncate();

        return redirect()->route('activity-logs.index')
            ->with('success', 'All activity logs have been cleared.');
    }
}
