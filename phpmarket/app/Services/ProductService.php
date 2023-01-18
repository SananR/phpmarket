<?php

namespace App\Services;

use App\Interfaces\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function productExists($id) {
        return !is_null($this->productRepository->getById($id));
    }
    public function getProduct($id) {
        return $this->productRepository->getById($id);
    }

    public function getAllProducts() {
        return $this->productRepository->getAll();
    }

    public function createProduct($store_id, $name, $bin, $quantity) {
        return $this->productRepository->create($store_id, $name, $bin, $quantity);
    }

    public function updateProduct($id, $request) {
        return $this->productRepository->update($id, $request);
    }

    public function deleteProduct($id) {
        $this->productRepository->delete($id);
    }







}
