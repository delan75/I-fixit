<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'api_opportunity_id',
        'source',
        'listing_url',
        'make',
        'model',
        'year',
        'auction_end_date',
        'current_bid',
        'lot_number',
        'auction_location',
        'stock_number',
        'odometer',
        'vehicle_code',
        'has_keys',
        'has_spare_key',
        'vehicle_starts',
        'has_battery',
        'has_spare_wheel',
        'color',
        'auction_date',
        'damage_description',
        'image_urls',
        'estimated_repair_cost',
        'estimated_market_value',
        'potential_profit',
        'opportunity_score',
        'status',
        'is_favorite',
        'user_notes',
        'last_viewed_at',
        'viewed_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'year' => 'integer',
        'auction_end_date' => 'datetime',
        'current_bid' => 'decimal:2',
        'estimated_repair_cost' => 'decimal:2',
        'estimated_market_value' => 'decimal:2',
        'potential_profit' => 'decimal:2',
        'opportunity_score' => 'integer',
        'has_keys' => 'boolean',
        'has_spare_key' => 'boolean',
        'vehicle_starts' => 'boolean',
        'has_battery' => 'boolean',
        'has_spare_wheel' => 'boolean',
        'is_favorite' => 'boolean',
        'auction_date' => 'date',
        'last_viewed_at' => 'datetime',
        'image_urls' => 'array',
    ];

    /**
     * Get the user who viewed this opportunity.
     */
    public function viewedBy()
    {
        return $this->belongsTo(User::class, 'viewed_by');
    }

    /**
     * Scope to filter high-scoring opportunities.
     */
    public function scopeHighScore($query, $minScore = 80)
    {
        return $query->where('opportunity_score', '>=', $minScore);
    }

    /**
     * Scope to filter by status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter favorites.
     */
    public function scopeFavorites($query)
    {
        return $query->where('is_favorite', true);
    }

    /**
     * Scope to filter by make and model.
     */
    public function scopeVehicle($query, $make = null, $model = null)
    {
        if ($make) {
            $query->where('make', 'like', "%{$make}%");
        }
        if ($model) {
            $query->where('model', 'like', "%{$model}%");
        }
        return $query;
    }

    /**
     * Scope to filter ending soon.
     */
    public function scopeEndingSoon($query, $hours = 24)
    {
        return $query->where('auction_end_date', '<=', now()->addHours($hours))
                    ->where('auction_end_date', '>', now());
    }

    /**
     * Get the vehicle description.
     */
    public function getVehicleDescriptionAttribute()
    {
        return "{$this->year} {$this->make} {$this->model}";
    }

    /**
     * Get the profit margin percentage.
     */
    public function getProfitMarginAttribute()
    {
        if (!$this->current_bid || $this->current_bid == 0) {
            return null;
        }

        return ($this->potential_profit / $this->current_bid) * 100;
    }
}
