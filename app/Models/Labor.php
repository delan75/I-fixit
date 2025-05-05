<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'labor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'service_type',
        'description',
        'provider_name',
        'provider_contact',
        'hours',
        'hourly_rate',
        'total_cost',
        'service_date',
        'completion_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'hours' => 'decimal:2',
        'hourly_rate' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'service_date' => 'date',
        'completion_date' => 'date',
    ];

    /**
     * Get the car that owns the labor entry.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
