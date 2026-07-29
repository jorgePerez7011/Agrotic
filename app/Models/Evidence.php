<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasFactory;

    protected $table = 'evidences';

    protected $fillable = [
        'photo',
        'description',
        'location',
        'date',
        'crop',
        'total_area',
        'cultivable_area',
        'terrain_zones',
        'planting_plan',
        'irrigation_system',
        'transit_route',
        'collection_plan',
        'additional_considerations',
        'summary',
        'estimated_investment',
        'status'
    ];

    protected $casts = [
        'date' => 'datetime',
        'status' => 'boolean',
        'total_area' => 'decimal:2',
        'cultivable_area' => 'decimal:2',
        'estimated_investment' => 'decimal:2'
    ];
}
