<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Journey;
use App\Http\Requests\StoreJourneyRequest;
use App\Http\Requests\UpdateJourneyRequest;
use App\Http\Resources\JourneyDetailsResource;
use Symfony\Component\HttpFoundation\Response;

class JourneyController extends Controller
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
    public function store(StoreJourneyRequest $request, Site $site)
    {
        $journey = $site->journeys()->create($request->validated());

        return response()->json([
            'message' => trans('messages.add'),
        ], Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     */
    public function show(Journey $journey)
    {
        return response()->json([
            'data' => new JourneyDetailsResource($journey),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJourneyRequest $request, Journey $journey)
    {
        $journey->update($request->validated());

        return response()->json([
            'message' => trans('messages.edit'),
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Journey $journey)
    {
        $journey->delete();

        return response()->json([
            'message' => trans('messages.delete'),
        ]);
    }
}
