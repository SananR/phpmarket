<?php

namespace App\Repositories;

use App\Interfaces\ProductRepository;
use App\Models\Product;

class EloquentProductRepository extends ProductRepository
{
    public function __construct()
    {
        parent::__construct(Product::class);
    }

}
