<?php

namespace App\Repositories;

use App\Interfaces\OrderProductRepository;
use App\Models\OrderProduct;

class EloquentOrderProductRepository extends OrderProductRepository
{
    public function __construct()
    {
        parent::__construct(OrderProduct::class);
    }

}
