<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'longitude',
        'latitude',
    ];

    public function admins() {
        return $this->belongsToMany(User::class, StoreAdmin::class, "user_id", "store_id");
    }

}
