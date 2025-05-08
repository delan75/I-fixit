<?php

namespace App\Models;

use App\Traits\HasAuthorization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DamagedPart extends Model
{
    use HasFactory, SoftDeletes, HasAuthorization;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'created_by',
        'updated_by',
        'part_name',
        'part_location',
        'damage_description',
        'estimated_repair_cost',
        'needs_replacement',
        'image_path',
        'is_repaired',
        'status',
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
        'deleted_at' => 'datetime',
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
