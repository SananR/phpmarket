<?php

namespace App\Repositories\eloquent;

use App\Models\Order;
use App\Repositories\OrderRepository;

class EloquentOrderRepository extends OrderRepository
{
    public function __construct()
    {
        parent::__construct(Order::class);
    }

}
