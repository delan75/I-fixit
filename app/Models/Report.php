<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Report extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'report_type_id',
        'user_id',
        'title',
        'filters',
        'data',
        'file_path',
        'file_type',
        'generated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'filters' => 'array',
        'data' => 'array',
        'generated_at' => 'datetime',
    ];

    /**
     * Get the report type that owns the report.
     */
    public function reportType()
    {
        return $this->belongsTo(ReportType::class);
    }

    /**
     * Get the user that owns the report.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the scheduled report that generated this report, if any.
     */
    public function scheduledReport()
    {
        return $this->belongsTo(ScheduledReport::class);
    }
}
