<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Jobs\CreateOrderJob;
use App\Models\StoreOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
        CreateOrderJob::dispatch();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreOrder  $storeOrder
     * @return \Illuminate\Http\Response
     */
    public function show(StoreOrder $storeOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreOrder  $storeOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreOrder $storeOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreOrder  $storeOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreOrder $storeOrder)
    {
        //
    }
}
