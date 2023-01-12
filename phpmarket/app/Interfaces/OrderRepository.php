<?php

namespace App\Interfaces;

abstract class OrderRepository extends BaseRepository
{
    public abstract function create($user_id, $payment_status);
    public abstract function updatePaymentStatus($id, $status);
    public abstract function delete($id);
}
