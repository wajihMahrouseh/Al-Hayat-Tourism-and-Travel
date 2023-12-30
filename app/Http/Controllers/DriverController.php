<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Driver;
use Spatie\QueryBuilder\QueryBuilder;
use App\Services\PaginationMetaService;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Http\Resources\DriversListResource;
use App\Http\Resources\DriverDetailsResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class DriverController extends Controller
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
        $driverQuery = QueryBuilder::for(Driver::class)
            ->with(['user'])
            ->allowedFilters([
                AllowedFilter::callback('name', function ($query, $value) {
                    $query->whereHas('user', function ($query) use ($value) {
                        $query->where('name', 'LIKE', $value);
                    });
                }),
            ])
            ->latest();

        $drivers = request()->page === null ? $driverQuery->get() : $driverQuery->paginate(request()->input('limit'));

        // Use PaginationMetaService to get pagination meta data
        $paginationMeta = $drivers instanceof LengthAwarePaginator ?
            $this->paginationMetaService->generatePaginationMeta($drivers) : null;

        return response()->json([
            'meta' => $paginationMeta,
            'data' => DriversListResource::collection($drivers),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
    {
        $user = User::create($request->validated()['userData']);
        $driver = $user->driver()->create($request->validated()['driverData']);

        $user->assignRole('driver');

        return response()->json([
            'message' => trans('messages.add'),
        ], Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        $driver->load(['user']);
        return response()->json([
            'data' => new DriverDetailsResource($driver),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $user = $driver->user->update($request->validated()['userData']);
        $driver->update($request->validated()['driverData']);

        return response()->json([
            'message' => trans('messages.edit'),
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return response()->json([
            'message' => trans('messages.delete'),
        ]);
    }
}
