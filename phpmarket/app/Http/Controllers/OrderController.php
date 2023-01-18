<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderProductRequest;
use App\Jobs\CreateOrderJob;
use App\Jobs\OrderProductJob;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    protected OrderService $orderService;

    public function __construct(OrderService $orderService) {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderCreateRequest $request)
    {
        $request->validated($request->all());
        $this->dispatch(new CreateOrderJob($this->orderService, $request->user_id, $request->products, $request->payment_status));
    }

    public function product(OrderProductRequest $request) {
        $request->validated($request->all());
        $this->dispatch(new OrderProductJob($this->orderService, $request->order_id, $request->product_id, $request->quantity));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $storeOrder
     * @return \Illuminate\Http\Response
     */
    public function show(Order $storeOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $storeOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $storeOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $storeOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $storeOrder)
    {
        //
    }
}
