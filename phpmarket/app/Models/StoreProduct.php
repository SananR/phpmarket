<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'bin',
        'quantity'
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }
}
