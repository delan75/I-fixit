<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamagedPart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'part_name',
        'part_location',
        'damage_description',
        'estimated_repair_cost',
        'needs_replacement',
        'image_path',
        'is_repaired',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'estimated_repair_cost' => 'decimal:2',
        'needs_replacement' => 'boolean',
        'is_repaired' => 'boolean',
    ];

    /**
     * Get the car that owns the damaged part.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Get the images for the damaged part.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
