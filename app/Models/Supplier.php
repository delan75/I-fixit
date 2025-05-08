<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\HasAuthorization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes, HasAuthorization, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'branch_name',
        'contact_person',
        'phone',
        'email',
        'address',
        'website',
        'notes',
        'created_by',
        'updated_by',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the parts for the supplier.
     */
    public function parts()
    {
        return $this->hasMany(Part::class);
    }
}
