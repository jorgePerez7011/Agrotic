<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'quantity',
        'provider_id',
        'status',
        'registered_by',
    ];

    protected $guarded = ['id', 'status', 'registered_by'];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
