<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'contact_person',
        'phone',
        'email',
        'address',
        'website',
        'notes',
    ];

    /**
     * Get the parts for the supplier.
     */
    public function parts()
    {
        return $this->hasMany(Part::class);
    }
}
