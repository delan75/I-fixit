<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\HasAuthorization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes, HasAuthorization, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'created_by',
        'updated_by',
        'make',
        'model',
        'variant',
        'year',
        'vin',
        'registration_number',
        'color',
        'interior_type',
        'body_type',
        'engine_size',
        'fuel_type',
        'transmission',
        'mileage',
        'features',
        'purchase_date',
        'purchase_price',
        'auction_house',
        'auction_branch',
        'auction_lot_number',
        'damage_description',
        'damage_severity',
        'operational_status',
        'vehicle_code',
        'current_phase',
        'repair_start_date',
        'repair_end_date',
        'dealership_date',
        'sold_date',
        'transportation_cost',
        'registration_papers_cost',
        'number_plates_cost',
        'dealership_discount',
        'other_costs',
        'other_costs_description',
        'estimated_repair_cost',
        'estimated_market_value',
        'notes',
        'form_completed',
        'form_step',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'features' => 'array',
        'purchase_date' => 'date',
        'repair_start_date' => 'date',
        'repair_end_date' => 'date',
        'dealership_date' => 'date',
        'sold_date' => 'date',
        'purchase_price' => 'decimal:2',
        'transportation_cost' => 'decimal:2',
        'registration_papers_cost' => 'decimal:2',
        'number_plates_cost' => 'decimal:2',
        'dealership_discount' => 'decimal:2',
        'other_costs' => 'decimal:2',
        'estimated_repair_cost' => 'decimal:2',
        'estimated_market_value' => 'decimal:2',
        'form_completed' => 'boolean',
        'form_step' => 'integer',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the user that owns the car.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the images for the car.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the damaged parts for the car.
     */
    public function damagedParts()
    {
        return $this->hasMany(DamagedPart::class);
    }

    /**
     * Get the parts for the car.
     */
    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    /**
     * Get the labor entries for the car.
     */
    public function laborEntries()
    {
        return $this->hasMany(Labor::class);
    }

    /**
     * Get the painting entries for the car.
     */
    public function paintingEntries()
    {
        return $this->hasMany(Painting::class);
    }

    /**
     * Get the sale record for the car.
     */
    public function sale()
    {
        return $this->hasOne(Sale::class);
    }

    /**
     * Get the documents for the car.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Calculate the total investment in the car.
     */
    public function getTotalInvestmentAttribute()
    {
        $partsCost = $this->parts()->sum('total_price');
        $laborCost = $this->laborEntries()->sum('total_cost');
        $paintingCost = $this->paintingEntries()->sum('total_cost');

        return $this->purchase_price +
               $this->transportation_cost +
               $this->registration_papers_cost +
               $this->number_plates_cost +
               $this->other_costs +
               $partsCost +
               $laborCost +
               $paintingCost;
    }

    /**
     * Calculate the actual profit or loss on the car (if sold).
     */
    public function getProfitLossAttribute()
    {
        if (!$this->sale || !$this->sale->selling_price) {
            return null;
        }

        return $this->sale->selling_price - $this->getTotalInvestmentAttribute();
    }

    /**
     * Calculate the projected profit or loss on the car based on estimated market value.
     */
    public function getProjectedProfitLossAttribute()
    {
        if (!$this->estimated_market_value) {
            return null;
        }

        return $this->estimated_market_value - $this->getTotalInvestmentAttribute();
    }

    /**
     * Calculate the actual ROI percentage (if sold).
     */
    public function getRoiPercentageAttribute()
    {
        if (!$this->sale || !$this->sale->selling_price || $this->getTotalInvestmentAttribute() == 0) {
            return null;
        }

        return ($this->getProfitLossAttribute() / $this->getTotalInvestmentAttribute()) * 100;
    }

    /**
     * Calculate the projected ROI percentage based on estimated market value.
     */
    public function getProjectedRoiPercentageAttribute()
    {
        if (!$this->estimated_market_value || $this->getTotalInvestmentAttribute() == 0) {
            return null;
        }

        return ($this->getProjectedProfitLossAttribute() / $this->getTotalInvestmentAttribute()) * 100;
    }

    /**
     * Calculate the days in repair.
     */
    public function getDaysInRepairAttribute()
    {
        if (!$this->repair_start_date) {
            return null;
        }

        $endDate = $this->repair_end_date ?? now();
        return $this->repair_start_date->diffInDays($endDate);
    }

    /**
     * Calculate the days at dealership.
     */
    public function getDaysAtDealershipAttribute()
    {
        if (!$this->dealership_date) {
            return null;
        }

        $endDate = $this->sold_date ?? now();
        return $this->dealership_date->diffInDays($endDate);
    }

    /**
     * Calculate the total days from purchase to sale or current date.
     */
    public function getTotalDaysAttribute()
    {
        if (!$this->purchase_date) {
            return null;
        }

        $endDate = $this->sold_date ?? now();
        return $this->purchase_date->diffInDays($endDate);
    }
}
