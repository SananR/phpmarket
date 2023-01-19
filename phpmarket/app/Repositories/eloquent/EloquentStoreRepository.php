<?php

namespace App\Repositories\eloquent;

use App\Models\Store;
use App\Repositories\StoreRepository;

class EloquentStoreRepository extends StoreRepository
{
    public function __construct()
    {
        parent::__construct(Store::class);
    }

}
