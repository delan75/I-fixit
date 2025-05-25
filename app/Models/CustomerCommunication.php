<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCommunication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'user_id',
        'car_id',
        'type',
        'direction',
        'subject',
        'content',
        'outcome',
        'requires_follow_up',
        'follow_up_date',
        'follow_up_notes',
        'follow_up_completed',
        'communication_date',
        'duration_minutes',
        'attachments',
        'priority',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'requires_follow_up' => 'boolean',
        'follow_up_date' => 'date',
        'follow_up_completed' => 'boolean',
        'communication_date' => 'datetime',
        'duration_minutes' => 'integer',
        'attachments' => 'array',
    ];

    /**
     * Get the customer that owns this communication.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user who made this communication.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the car related to this communication.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Scope to filter communications requiring follow-up.
     */
    public function scopeRequiresFollowUp($query)
    {
        return $query->where('requires_follow_up', true)
                    ->where('follow_up_completed', false);
    }

    /**
     * Scope to filter overdue follow-ups.
     */
    public function scopeOverdueFollowUp($query)
    {
        return $query->where('requires_follow_up', true)
                    ->where('follow_up_completed', false)
                    ->where('follow_up_date', '<', now());
    }

    /**
     * Scope to filter by communication type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
