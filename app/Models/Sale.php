<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'listing_date',
        'asking_price',
        'platform',
        'selling_price',
        'sale_date',
        'buyer_name',
        'buyer_contact',
        'commission',
        'fees',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'listing_date' => 'date',
        'asking_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'sale_date' => 'date',
        'commission' => 'decimal:2',
        'fees' => 'decimal:2',
    ];

    /**
     * Get the car that owns the sale.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
