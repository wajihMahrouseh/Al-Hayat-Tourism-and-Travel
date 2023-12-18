<?php

namespace App\Http\Controllers;

use App\Models\ReservationOrder;
use App\Http\Requests\StoreReservationOrderRequest;
use App\Http\Requests\UpdateReservationOrderRequest;

class ReservationOrderController extends Controller
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
    public function store(StoreReservationOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReservationOrder $reservationOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationOrderRequest $request, ReservationOrder $reservationOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReservationOrder $reservationOrder)
    {
        //
    }
}
