<?php

namespace App\Services;

use App\Interfaces\OrderProductRepository;
use App\Interfaces\OrderRepository;

class OrderService extends BaseService
{

    protected OrderProductRepository $orderProductRepository;

    public function __construct(OrderRepository $orderRepository, OrderProductRepository $orderProductRepository) {
        parent::__construct($orderRepository);
        $this->orderProductRepository = $orderProductRepository;
    }

    public function getOrderProducts($order_id) {

    }

    public function getOrder($order_id) {
        return parent::get($order_id);
    }

    public function createOrder($user_id) {
        return $this->repository->create($user_id, "PENDING");
    }

    public function getOrderProduct($order_id, $product_id) {
        foreach ($this->repository->getById($order_id)->products() as $product) {
            if ($product == $product_id) return $product;
        }
        return null;
    }
    public function createOrderProduct($order_id, $product_id, $quantity) {
        return $this->orderProductRepository->create($order_id, $product_id, $quantity);
    }
    public function setProductQuantity($order_product_id, $quantity) {
        return $this->orderProductRepository->update($order_product_id, ['quantity'=>$quantity]);
    }






}