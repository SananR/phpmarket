<?php

namespace App\Services;

use App\Interfaces\BaseService;
use App\Repositories\ProductRepository;

class ProductService extends BaseService
{

    public function __construct(ProductRepository $productRepository) {
        parent::__construct($productRepository);
    }

    public function getProduct($id) {
        return parent::get($id);
    }

    public function createProduct($store_id, $name, $bin, $quantity) {
        return $this->repository->create($store_id, $name, $bin, $quantity);
    }

    public function updateProduct($id, $request) {
        return $this->repository->update($id, $request);
    }

    public function deleteProduct($id) {
        $this->repository->delete($id);
    }







}
