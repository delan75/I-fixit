<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Painting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'painting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'painting_type',
        'areas_covered',
        'provider_name',
        'provider_contact',
        'material_cost',
        'labor_cost',
        'total_cost',
        'start_date',
        'completion_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'material_cost' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'start_date' => 'date',
        'completion_date' => 'date',
    ];

    /**
     * Get the car that owns the painting entry.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
