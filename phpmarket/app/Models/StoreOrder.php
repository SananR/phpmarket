<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\StoreOrder
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|StoreOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreOrder query()
 * @mixin \Eloquent
 */
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
        return $this->hasManyThrough(Product::class, OrderProduct::class);
    }




}
