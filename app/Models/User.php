<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Auditable;
use App\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'gender',
        'password',
        'role',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be masked in audit logs.
     *
     * @var array
     */
    protected $sensitiveFields = [
        'password',
        'remember_token',
    ];

    /**
     * The events that should be audited.
     *
     * @var array
     */
    protected $auditableEvents = [
        'created',
        'updated',
        'deleted',
        'restored',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        return $this->name;
    }

    /**
     * Set the user's name attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        // If first_name and last_name are not set, try to extract them from name
        if (empty($this->attributes['first_name']) && empty($this->attributes['last_name']) && !empty($value)) {
            $parts = explode(' ', $value, 2);
            $this->attributes['first_name'] = $parts[0];
            $this->attributes['last_name'] = $parts[1] ?? '';
        }
    }

    /**
     * Get the cars for the user.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    /**
     * Get the cars created by the user.
     */
    public function createdCars()
    {
        return $this->hasMany(Car::class, 'created_by');
    }

    /**
     * Scope a query to only include active users.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include inactive users.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Mark the user as inactive (soft delete).
     */
    public function markAsInactive()
    {
        $this->status = 'inactive';
        $this->save();

        return $this;
    }

    /**
     * Mark the user as active.
     */
    public function markAsActive()
    {
        $this->status = 'active';
        $this->save();

        return $this;
    }

    /**
     * Check if the user is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user has the given role.
     * This is a fallback method in case the trait method doesn't work.
     */
    public function checkRole($roleName)
    {
        return $this->role === $roleName;
    }
}
