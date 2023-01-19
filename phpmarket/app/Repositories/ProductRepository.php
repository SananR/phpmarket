<?php

namespace App\Repositories;

use App\Interfaces\BaseRepository;

abstract class ProductRepository extends BaseRepository
{
    public function __construct($modelOrm) {
        parent::__construct($modelOrm);
    }

    public function create($store_id, $name, $bin, $quantity) {
        return parent::create([
            'store_id' => $store_id,
            'name' => $name,
            'bin' => $bin,
            'quantity' => $quantity
        ]);
    }


}
