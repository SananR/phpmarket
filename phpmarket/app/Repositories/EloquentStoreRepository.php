<?php

namespace App\Repositories;

use App\Interfaces\StoreRepository;
use App\Models\Store;

class EloquentStoreRepository extends StoreRepository
{
    public function __construct()
    {
        parent::__construct(Store::class);
    }

}
