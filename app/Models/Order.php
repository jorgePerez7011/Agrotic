<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date_order',
        'total',
        'route',
        'status',
        "registered_by",
        'client_id',
    ];

    protected $guarded = ['id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Get the evidences for the order
     */
    public function evidences()
    {
        return $this->hasMany(Evidence::class);
    }
}
