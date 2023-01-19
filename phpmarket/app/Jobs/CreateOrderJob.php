<?php

namespace App\Jobs;

use App\Interfaces\BaseJob;
use App\Models\PaymentStatus;
use App\Services\OrderService;
use App\Services\ProductService;

class CreateOrderJob extends BaseJob
{

    protected $user_id, $products, $payment_status;
    protected OrderService $orderService;
    protected ProductService $productService;

    public function __construct(OrderService $orderService, ProductService $productService, $user_id, $products, $payment_status)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->user_id = $user_id;
        $this->products = $products;
        $this->payment_status = $payment_status;
        parent::__construct();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Create the order
        $order = $this->orderService->createOrder($this->user_id);
        //Add the products
        if (empty($this->products)) return;
        foreach ($this->products as $id) {
            OrderProductJob::dispatch($this->orderService, $this->productService, $order->id, $id, 1);
        }
    }

    public function validate()
    {
        //Validate products
        foreach ($this->products as $id) {
           if (!$this->productService->exists($id)) return false;
        }
        $ps = PaymentStatus::from($this->payment_status);
        if ($ps != PaymentStatus::PENDING && $ps != PaymentStatus::COMPLETED) return false;
        return true;
    }
}
