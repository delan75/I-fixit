<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'image_path',
        'image_type',
        'description',
    ];

    /**
     * Get the car that owns the image.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
