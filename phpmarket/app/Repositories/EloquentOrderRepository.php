<?php

namespace App\Repositories;

use App\Interfaces\OrderRepository;
use App\Models\StoreOrder;

class EloquentOrderRepository implements OrderRepository
{

    public function getAll() {
        return StoreOrder::all();
    }
    public function getById($id)
    {
        return StoreOrder::findOrFail(intval($id));
    }
    public function create($user_id, $payment_status) {
        return StoreOrder::create([
            'user_id'=>$user_id,
            'payment_status'=>$payment_status,
        ]);
    }

    public function updatePaymentStatus($id, $status) {
        $order = StoreOrder::where('id', $id)->get()->first();
        $order->update(['payment_status'=>$status]);
        return $order;
    }

    public function delete($id) {
        StoreOrder::destroy($id);
    }


}
