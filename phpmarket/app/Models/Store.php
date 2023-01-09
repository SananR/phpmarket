<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'address',
        'orders',
    ];

    public function user() {
        return $this->belongsToMany(User::class, "owner_id");
    }


}
