<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StoreOrder extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->hasManyThrough(StoreProduct::class, StoreOrderProduct::class);
    }




}
