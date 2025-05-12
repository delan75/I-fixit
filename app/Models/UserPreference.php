<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'preferred_makes',
        'preferred_models',
        'min_year',
        'max_year',
        'min_profit',
        'max_investment',
        'notification_email',
        'notification_sms',
        'notification_app',
        'notification_repair_phase',
        'notification_dealership_phase',
        'notification_budget_exceeded',
        'notification_opportunity',
        'repair_phase_days_threshold',
        'dealership_phase_days_threshold',
        'budget_exceeded_percentage',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'preferred_makes' => 'array',
        'preferred_models' => 'array',
        'min_year' => 'integer',
        'max_year' => 'integer',
        'min_profit' => 'decimal:2',
        'max_investment' => 'decimal:2',
        'notification_email' => 'boolean',
        'notification_sms' => 'boolean',
        'notification_app' => 'boolean',
        'notification_repair_phase' => 'boolean',
        'notification_dealership_phase' => 'boolean',
        'notification_budget_exceeded' => 'boolean',
        'notification_opportunity' => 'boolean',
        'repair_phase_days_threshold' => 'integer',
        'dealership_phase_days_threshold' => 'integer',
        'budget_exceeded_percentage' => 'integer',
    ];

    /**
     * Get the user that owns the preferences.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
