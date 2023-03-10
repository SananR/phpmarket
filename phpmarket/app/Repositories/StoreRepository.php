<?php

namespace App\Repositories;

use App\Interfaces\BaseRepository;

abstract class StoreRepository extends BaseRepository
{
    public function __construct($modelOrm) {
        parent::__construct($modelOrm);
    }

    public function create($name, $address, $longitude, $latitude) {
        return parent::create([
            'name' => $name,
            'address' => $address,
            'longitude' => $longitude,
            'latitude' => $latitude
        ]);
    }


}
