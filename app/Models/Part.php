<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'name',
        'description',
        'condition',
        'quantity',
        'unit_price',
        'total_price',
        'purchase_date',
        'installation_date',
        'supplier_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'purchase_date' => 'date',
        'installation_date' => 'date',
    ];

    /**
     * Get the car that owns the part.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Get the supplier that provides the part.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
