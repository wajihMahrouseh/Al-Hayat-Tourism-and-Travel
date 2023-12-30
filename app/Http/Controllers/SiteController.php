<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Category;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use App\Http\Resources\SiteDetailsResource;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
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
    public function store(StoreSiteRequest $request, Category $category)
    {
        $site = $category->sites()->create($request->validated());

        // Handle multiple photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $site->addMedia($photo)->toMediaCollection('photos');
            }
        }

        return response()->json([
            'message' => trans('messages.add'),
        ], Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        $site->load(['media', 'journeys']);

        return response()->json([
            'data' => new SiteDetailsResource($site),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiteRequest $request, Site $site)
    {
        $site->update($request->validated());

        // Handle multiple photo uploads
        if ($request->hasFile('photos')) {
            $site->clearMediaCollection('photos');
            foreach ($request->file('photos') as $photo) {
                $site->addMedia($photo)->toMediaCollection('photos');
            }
        }

        return response()->json([
            'message' => trans('messages.edit'),
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        $site->delete();

        return response()->json([
            'message' => trans('messages.delete'),
        ]);
    }
}
