<?php

namespace App\Jobs;

use App\Services\OrderService;
use App\Jobs\OrderProductJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use function PHPUnit\Framework\isEmpty;

class CreateOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_id, $products, $payment_status;
    protected OrderService $orderService;

    public function __construct(OrderService $orderService, $user_id, $products, $payment_status)
    {
        $this->orderService = $orderService;
        $this->user_id = $user_id;
        $this->products = $products;
        $this->payment_status = $payment_status;
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
            OrderProductJob::dispatch($this->orderService, $order->id, $id, 1);
        }
    }
}
