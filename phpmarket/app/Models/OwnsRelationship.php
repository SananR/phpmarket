<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnsRelationship extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'store_id',
    ];

    public function user() {
        return $this->hasOne(User::class, "owner_id");
    }

    public function store() {
        return $this->hasOne(Store::class);
    }



}
