<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Spatie\QueryBuilder\QueryBuilder;
use App\Services\PaginationMetaService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreNotificationRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\UpdateNotificationRequest;
use App\Http\Resources\NotificationsListResource;
use App\Http\Resources\NotificationDetailsResource;

class NotificationController extends Controller
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
        $notificationsQuery = QueryBuilder::for(Notification::class)
            ->with(['media'])
            ->select(['id', 'title', 'description', 'date', 'created_at'])
            ->allowedFilters(['title'])
            ->latest();

        $notifications = request()->page === null ? $notificationsQuery->get() : $notificationsQuery->paginate(request()->input('limit'));

        // Use PaginationMetaService to get pagination meta data
        $paginationMeta = $notifications instanceof LengthAwarePaginator ?
            $this->paginationMetaService->generatePaginationMeta($notifications) : null;

        return response()->json([
            'meta' => $paginationMeta,
            'data' => NotificationsListResource::collection($notifications),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request)
    {
        $notification = Notification::create($request->validated());

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $notification->addMedia($photo)->toMediaCollection('photos');
        }

        return response()->json([
            'message' => trans('messages.add'),
        ], Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        $notification->load(['media']);

        return response()->json([
            'data' => new NotificationDetailsResource($notification),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        $notification->update($request->validated());

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $notification->clearMediaCollection('photos');
            $photo = $request->file('photo');
            $notification->addMedia($photo)->toMediaCollection('photos');
        }

        return response()->json([
            'message' => trans('messages.edit'),
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return response()->json([
            'message' => trans('messages.delete'),
        ]);
    }
}
