<?php

namespace App\Repositories;

use App\Interfaces\OrderRepository;
use App\Models\Order;

class EloquentOrderRepository extends OrderRepository
{
    public function __construct()
    {
        parent::__construct(Order::class);
    }

}
