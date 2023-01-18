<?php

namespace App\Interfaces;

abstract class OrderProductRepository extends BaseRepository
{
    public function create($order_id, $product_id, $quantity) {
        return parent::create([
            'order_id' => $order_id,
            'product_id'=>$product_id,
            'quantity' => $quantity,
        ]);
    }

    public function getByOrder($order_id) {
        $arr = [];
        foreach ($this->where('order_id', $order_id) as $orderProduct) {
            $arr[] = $orderProduct;
        }
        return $arr;
    }


}
