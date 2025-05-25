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
        'buyer_finance_type',
        'buyer_finance_institution',
        'finance_approved_amount',
        'deposit_amount',
        'outstanding_balance',
        'finance_approval_date',
        'full_payment_date',
        'finance_notes',
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
        'finance_approved_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'outstanding_balance' => 'decimal:2',
        'finance_approval_date' => 'date',
        'full_payment_date' => 'date',
    ];

    /**
     * Get the car that owns the sale.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
