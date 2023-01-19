<?php

namespace App\Repositories\eloquent;

use App\Models\Product;
use App\Repositories\ProductRepository;

class EloquentProductRepository extends ProductRepository
{
    public function __construct()
    {
        parent::__construct(Product::class);
    }

}
