<?php

namespace App\Jobs;

use App\Interfaces\BaseJob;
use App\Services\OrderService;
use App\Services\ProductService;

class OrderProductJob extends BaseJob
{

    protected $order_id, $product_id, $quantity;
    protected OrderService $orderService;
    protected ProductService $productService;

    public function __construct(OrderService $orderService, ProductService $productService, $order_id, $product_id, $quantity)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        parent::__construct();
    }

    public function validate():bool {
        if (!$this->orderService->exists($this->order_id)) return false;
        if (!$this->productService->exists($this->product_id)) return false;
        //Not enough product
        if ($this->productService->getProduct($this->product_id)->quantity < $this->quantity) return false;
        return true;
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
            //deletion
            if ($this->quantity <= 0) {
                $this->orderService->deleteOrderProduct($orderProduct->id);
                return;
            }
            $this->orderService->setProductQuantity($orderProduct->id, $this->quantity);
        } else if ($this->quantity > 0) {
            //Create the order
            $this->orderService->createOrderProduct($this->order_id, $this->product_id, $this->quantity);
        }
    }

}
