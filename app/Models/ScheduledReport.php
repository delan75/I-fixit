<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'report_type_id',
        'user_id',
        'name',
        'frequency',
        'filters',
        'time',
        'day_of_week',
        'day_of_month',
        'recipients',
        'export_format',
        'is_active',
        'last_run_at',
        'next_run_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'filters' => 'array',
        'is_active' => 'boolean',
        'time' => 'datetime:H:i',
        'last_run_at' => 'datetime',
        'next_run_at' => 'datetime',
    ];

    /**
     * Get the report type that owns the scheduled report.
     */
    public function reportType()
    {
        return $this->belongsTo(ReportType::class);
    }

    /**
     * Get the user that owns the scheduled report.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reports generated from this scheduled report.
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Scope a query to only include active scheduled reports.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include scheduled reports that are due to run.
     */
    public function scopeDue($query)
    {
        return $query->where('is_active', true)
            ->where('next_run_at', '<=', now());
    }

    /**
     * Calculate the next run time based on frequency.
     */
    public function calculateNextRunTime()
    {
        $now = now();
        $time = $this->time ? \Carbon\Carbon::parse($this->time) : \Carbon\Carbon::parse('00:00');

        switch ($this->frequency) {
            case 'daily':
                // If today's scheduled time has passed, set for tomorrow
                $nextRun = $now->copy()->setHour($time->hour)->setMinute($time->minute)->setSecond(0);
                if ($nextRun->isPast()) {
                    $nextRun->addDay();
                }
                break;

            case 'weekly':
                // Set to the specified day of week
                $dayOfWeek = $this->day_of_week ?: 'monday';
                $nextRun = $now->copy()->next($dayOfWeek)->setHour($time->hour)->setMinute($time->minute)->setSecond(0);
                break;

            case 'monthly':
                // Set to the specified day of month
                $dayOfMonth = $this->day_of_month ?: 1;
                $nextRun = $now->copy()->firstOfMonth()->addDays($dayOfMonth - 1)->setHour($time->hour)->setMinute($time->minute)->setSecond(0);
                if ($nextRun->isPast()) {
                    $nextRun->addMonth();
                }
                break;

            default:
                // Default to tomorrow
                $nextRun = $now->copy()->addDay()->setHour($time->hour)->setMinute($time->minute)->setSecond(0);
        }

        return $nextRun;
    }

    /**
     * Update the next run time after a report has been generated.
     */
    public function updateNextRunTime()
    {
        $this->last_run_at = now();
        $this->next_run_at = $this->calculateNextRunTime();
        $this->save();
    }
}
