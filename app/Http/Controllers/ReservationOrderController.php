<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\ReservationOrder;
use App\Models\CompanyJourneySeat;
use App\Models\IndividualJourneySeat;
use Spatie\QueryBuilder\QueryBuilder;
use App\Services\PaginationMetaService;
use App\Http\Resources\StatisticsResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\StoreReservationOrderRequest;
use App\Http\Requests\UpdateReservationOrderRequest;
use App\Http\Requests\ChangeReservationJourneyStatus;
use App\Http\Resources\ReservationOrdersListResource;
use App\Http\Resources\CompanyJourneySeatListResource;
use App\Http\Resources\ReservationOrderDetailsResource;
use App\Http\Resources\IndividualJourneySeatListResource;
use App\Http\Requests\StoreCompanyReservationOrderRequest;
use App\Http\Resources\IndividualJourneySeatDetailsResource;

class ReservationOrderController extends Controller
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
        $reservationOrdersQuery = QueryBuilder::for(ReservationOrder::class)
            ->with([
                'journey' => ['site'],
                'deliveryOrder'
            ])
            ->whereHas('individualJourneySeats')
            ->allowedFilters(['status'])
            ->latest();

        $reservationOrders = request()->page === null ? $reservationOrdersQuery->get() : $reservationOrdersQuery->paginate(request()->input('limit'));

        // Use PaginationMetaService to get pagination meta data
        $paginationMeta = $reservationOrders instanceof LengthAwarePaginator ?
            $this->paginationMetaService->generatePaginationMeta($reservationOrders) : null;

        return response()->json([
            'meta' => $paginationMeta,
            'data' => ReservationOrdersListResource::collection($reservationOrders),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeCustomerReservationOrder(StoreReservationOrderRequest $request, Journey $journey)
    {
        $reservationOrder = $journey->reservationOrder()->create($request->validatedReservationOrder());
        // $reservationOrder->individualJourneySeats()->createMany($request->validatedIndividualSeatDetails());


        $dataToCreate = $request->validatedIndividualSeatDetails();

        // Create a collection of the data
        $individualSeatDetailsCollectionToCreate = collect($dataToCreate);

        $individualSeatDetails = []; // Initialize an empty array
        foreach ($individualSeatDetailsCollectionToCreate as $individualSeatDetailsToCreate) {
            $individualSeatDetailsRecord = $reservationOrder->individualJourneySeats()->create($individualSeatDetailsToCreate);
            $individualSeatDetails[] = $individualSeatDetailsRecord;
        }


        if ($request->files) {
            $filesObject = $request->files;

            foreach ($filesObject as $value) {
                foreach ($value as $index => $files) {
                    $item = $individualSeatDetails[$index];
                    $frontId = $files['frontId'];
                    $backId = $files['backId'];

                    $item->addMedia($frontId)
                        ->preservingOriginal()
                        ->toMediaCollection('file');

                    $item->addMedia($backId)
                        ->preservingOriginal()
                        ->toMediaCollection('file');
                }
            }
        }


        return response()->json([
            'message' => trans('messages.add')
        ], Response::HTTP_CREATED);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeCompanyReservationOrder(StoreCompanyReservationOrderRequest $request, Journey $journey)
    {
        $reservationOrder = $journey->reservationOrder()->create($request->validatedReservationOrder());
        $reservationOrder->companyJourneySeats()->create($request->validatedCompanySeatDetails());

        return response()->json([
            'message' => trans('messages.add')
        ], Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     */
    // public function show(ReservationOrder $reservationOrder)
    public function show(ReservationOrder $reservationOrder)
    {
        $reservationOrder->load(['individualJourneySeats', 'journey' => ['site'], 'deliveryOrder']);

        return response()->json([
            'data' => new ReservationOrderDetailsResource($reservationOrder),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateCompanyReservationOrder(UpdateReservationOrderRequest $request, ReservationOrder $reservationOrder)
    {
        // $reservationOrder->companyJourneySeats->update($request->validated());

        // return response()->json([
        //     'message' => trans('messages.edit')
        // ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateCustomerReservationOrder(UpdateReservationOrderRequest $request, ReservationOrder $reservationOrder)
    {
        // $reservationOrder->update($request->validated());

        // return response()->json([
        //     'message' => trans('messages.edit')
        // ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReservationOrder $reservationOrder)
    {
        $reservationOrder->delete();

        return response()->json([
            'message' => trans('messages.delete')
        ]);
    }


    public function ChangeReservationJourneyStatus(ChangeReservationJourneyStatus $request, ReservationOrder $reservationOrder)
    {
        $reservationOrder->update($request->validated());

        return response()->json([
            'message' => trans('messages.edit')
        ]);
    }


    public function journeyReservations(Journey $journey)
    {

        $companyJourneySeats = CompanyJourneySeat::whereHas('reservationOrder', function ($query) use ($journey) {
            $query->whereHas('journey', function ($query) use ($journey) {
                $query->where('id', $journey->id);
            });
        })->get();

        $individualJourneySeats = IndividualJourneySeat::whereHas('reservationOrder', function ($query) use ($journey) {
            $query->whereHas('journey', function ($query) use ($journey) {
                $query->where('id', $journey->id);
            });
        })->get();

        // $reservationOrder = $journey->reservationOrder->load(['companyJourneySeats', 'individualJourneySeats']);

        return response()->json([
            // 'data' => ReservationOrderDetailsResource::collection($reservationOrder),
            // 'companyJourneySeats' =>  CompanyJourneySeatListResource::collection($reservationOrder->companyJourneySeats),
            // 'individualJourneySeats' => IndividualJourneySeatListResource::collection($reservationOrder->individualJourneySeats),

            'data' => [
                'companyJourneySeats' =>  CompanyJourneySeatListResource::collection($companyJourneySeats),
                'individualJourneySeats' => IndividualJourneySeatListResource::collection($individualJourneySeats),
            ]
        ]);
    }


    public function seatDetails(IndividualJourneySeat $individualJourneySeat)
    {
        $individualJourneySeat->load(['media']);

        return response()->json([
            'data' => new IndividualJourneySeatDetailsResource($individualJourneySeat),
        ]);
    }


    public function statistics()
    {
        $journeys = Journey::with(['site'])->withCount(['individualJourneySeats'])->get();

        return response()->json([
            'data' => StatisticsResource::collection($journeys)
        ]);
    }
}
