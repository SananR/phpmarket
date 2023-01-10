<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'store_id',
        'payment_status'
    ];

    public function store() {
        return $this->hasOne(Store::class);
    }
    public function order() {
        return $this->hasOne(StoreOrder::class);
    }

}
