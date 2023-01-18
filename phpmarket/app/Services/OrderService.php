<?php

namespace App\Services;

use App\Interfaces\OrderProductRepository;
use App\Interfaces\OrderRepository;
use App\Models\PaymentStatus;

class OrderService extends BaseService
{

    protected OrderProductRepository $orderProductRepository;

    public function __construct(OrderRepository $orderRepository, OrderProductRepository $orderProductRepository) {
        parent::__construct($orderRepository);
        $this->orderProductRepository = $orderProductRepository;
    }

    public function getOrder($order_id) {
        return parent::get($order_id);
    }

    public function createOrder($user_id) {
        return $this->repository->create($user_id, PaymentStatus::PENDING->value);
    }

    public function deleteOrderProduct($id) {
        $this->orderProductRepository->delete($id);
    }

    public function getOrderProduct($order_id, $product_id) {
        $products = $this->orderProductRepository->getByOrder($order_id);
        foreach ($products as $product) {
            if ($product->product_id == $product_id) return $product;
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
