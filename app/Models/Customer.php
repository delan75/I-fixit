<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'created_by',
        'updated_by',
        'first_name',
        'last_name',
        'email',
        'phone',
        'id_number',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'province',
        'postal_code',
        'preferences',
        'notes',
        'customer_type',
        'company_name',
        'vat_number',
        'status',
        'satisfaction_rating',
        'is_repeat_customer',
        'total_purchases',
        'total_spent',
        'email_notifications',
        'sms_notifications',
        'marketing_consent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'satisfaction_rating' => 'integer',
        'is_repeat_customer' => 'boolean',
        'total_purchases' => 'integer',
        'total_spent' => 'decimal:2',
        'email_notifications' => 'boolean',
        'sms_notifications' => 'boolean',
        'marketing_consent' => 'boolean',
    ];

    /**
     * Get the user who created this customer.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this customer.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get all communications for this customer.
     */
    public function communications()
    {
        return $this->hasMany(CustomerCommunication::class);
    }

    /**
     * Get all sales for this customer.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class, 'buyer_name', 'first_name'); // This is a simplified relationship
    }

    /**
     * Get the customer's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Scope to filter active customers.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to filter repeat customers.
     */
    public function scopeRepeat($query)
    {
        return $query->where('is_repeat_customer', true);
    }
}
