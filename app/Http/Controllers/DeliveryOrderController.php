<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use App\Http\Requests\StoreDeliveryOrderRequest;
use App\Http\Requests\UpdateDeliveryOrderRequest;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryOrder $deliveryOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryOrderRequest $request, DeliveryOrder $deliveryOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryOrder $deliveryOrder)
    {
        //
    }
}
