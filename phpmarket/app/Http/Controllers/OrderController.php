<?php

namespace App\Http\Controllers;

use App\Http\Requests\order\OrderCreateRequest;
use App\Http\Requests\order\OrderProductRequest;
use App\Jobs\CreateOrderJob;
use App\Jobs\OrderProductJob;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    protected OrderService $orderService;
    protected ProductService $productService;

    public function __construct(OrderService $orderService, ProductService $productService) {
        $this->orderService = $orderService;
        $this->productService = $productService;
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
        $this->dispatch(new CreateOrderJob($this->orderService, $this->productService, $request->user_id, $request->products, "PENDING"));
    }

    public function product(OrderProductRequest $request) {
        $request->validated($request->all());
        $this->dispatch(new OrderProductJob($this->orderService, $this->productService, $request->order_id, $request->product_id, $request->quantity));
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
