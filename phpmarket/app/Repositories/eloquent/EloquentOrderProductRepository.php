<?php

namespace App\Repositories\eloquent;

use App\Models\OrderProduct;
use App\Repositories\OrderProductRepository;

class EloquentOrderProductRepository extends OrderProductRepository
{
    public function __construct()
    {
        parent::__construct(OrderProduct::class);
    }

}
