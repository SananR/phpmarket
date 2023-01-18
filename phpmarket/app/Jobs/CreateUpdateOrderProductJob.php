<?php

namespace App\Jobs;

use App\Services\OrderService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateUpdateOrderProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order_id, $product_id, $quantity;
    protected OrderService $orderService;

    public function __construct(OrderService $orderService, $order_id, $product_id, $quantity)
    {
        $this->orderService = $orderService;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = $this->orderService->getOrder($this->order_id);
        //Already has (update quantity)
        if ($order->hasProduct($this->product_id)) {
            $orderProduct = $this->orderService->getOrderProduct($this->order_id, $this->product_id);
            $this->orderService->setProductQuantity($orderProduct->id, $this->quantity);
        } else {
            //Create the order
            $this->orderService->createOrderProduct($this->order_id, $this->product_id, $this->quantity);
        }
    }

}
