<?php

namespace App\Repositories;

use App\Interfaces\BaseRepository;

abstract class OrderRepository extends BaseRepository
{
    public function create($user_id, $payment_status) {
        return parent::create([
            'user_id' => $user_id,
            'products'=>[],
            'payment_status' => $payment_status,
        ]);
    }

    public function updatePaymentPending($id) {
        return parent::update($id, ['payment_status'=>'PENDING']);
    }

    public function updatePaymentCompleted($id, $status) {
        return parent::update($id, ['payment_status'=>'COMPLETED']);
    }

}
