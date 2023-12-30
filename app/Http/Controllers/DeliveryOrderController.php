<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use App\Models\ReservationOrder;
use Spatie\QueryBuilder\QueryBuilder;
use App\Services\PaginationMetaService;
use App\Http\Requests\AcceptDeliveryOrder;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\ChangeDeliveryOrderStatus;
use App\Http\Requests\StoreDeliveryOrderRequest;
use App\Http\Requests\UpdateDeliveryOrderRequest;
use App\Http\Resources\DeliveryOrdersListResource;
use App\Http\Resources\DeliveryOrderDetailsResource;

class DeliveryOrderController extends Controller
{
    protected $paginationMetaService;

    public function __construct(PaginationMetaService $paginationMetaService)
    {
        $this->paginationMetaService = $paginationMetaService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryOrdersQuery = QueryBuilder::for(DeliveryOrder::class)
            ->allowedFilters(['status'])
            ->latest();

        $reservationOrders = request()->page === null ? $deliveryOrdersQuery->get() : $deliveryOrdersQuery->paginate(request()->input('limit'));

        // Use PaginationMetaService to get pagination meta data
        $paginationMeta = $reservationOrders instanceof LengthAwarePaginator ?
            $this->paginationMetaService->generatePaginationMeta($reservationOrders) : null;

        return response()->json([
            'meta' => $paginationMeta,
            'data' => DeliveryOrdersListResource::collection($reservationOrders),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryOrderRequest $request, ReservationOrder $reservationOrder)
    {
        $reservationOrder->deliveryOrder()->create($request->validated());

        return response()->json([
            'message' => trans('messages.add')
        ], Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     */
    public function show(DeliveryOrder $deliveryOrder)
    {
        return response()->json([
            'data' => new DeliveryOrderDetailsResource($deliveryOrder),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryOrderRequest $request, DeliveryOrder $deliveryOrder)
    {
        $deliveryOrder->update($request->validated());

        return response()->json([
            'message' => trans('messages.edit')
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryOrder $deliveryOrder)
    {
        $deliveryOrder->delete();

        return response()->json([
            'message' => trans('messages.delete')
        ]);
    }


    public function acceptDeliveryOrder(AcceptDeliveryOrder $request, DeliveryOrder $deliveryOrder)
    {
        $deliveryOrder->drivers()->sync($request->input('driversId'));
        $deliveryOrder->status = 2;
        $deliveryOrder->save();

        return response()->json([
            'message' => trans('messages.edit')
        ]);
    }


    public function driverDeliveryOrderList()
    {
        $deliveryOrdersQuery = auth()->user()->driver->deliveryOrder();

        $reservationOrders = request()->page === null ? $deliveryOrdersQuery->get() : $deliveryOrdersQuery->paginate(request()->input('limit'));

        // Use PaginationMetaService to get pagination meta data
        $paginationMeta = $reservationOrders instanceof LengthAwarePaginator ?
            $this->paginationMetaService->generatePaginationMeta($reservationOrders) : null;

        return response()->json([
            'meta' => $paginationMeta,
            'data' => DeliveryOrdersListResource::collection($reservationOrders),
        ]);
    }


    public function driverDeliveryOrderShow(DeliveryOrder $deliveryOrder)
    {
        return response()->json([
            'data' => new DeliveryOrderDetailsResource($deliveryOrder),
        ]);
    }


    public function changeDeliveryOrderStatus(ChangeDeliveryOrderStatus $request, DeliveryOrder $deliveryOrder)
    {
        $driverId = auth()->user()->driver->id;

        $deliveryOrder->drivers()->updateExistingPivot($driverId, ['status' => $request->input('status')]);

        return response()->json([
            'message' => trans('messages.edit')
        ]);
    }
}
