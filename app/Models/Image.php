<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasAuthorization;

class Image extends Model
{
    use HasFactory, SoftDeletes, HasAuthorization;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image_path',
        'description',
        'image_type',
        'imageable_id',
        'imageable_type',
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
     * Get the parent imageable model (car, damaged part, etc).
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
