<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\SettingsDetailsResource;

class SettingController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request)
    {
        $setting = Setting::updateOrCreate($request->validated());

        return response()->json([
            'message' => trans('messages.add'),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $setting = Setting::first();

        if ($setting) {
            return response()->json([
                'data' => new SettingsDetailsResource($setting),
            ]);
        }

        return response()->json([
            'data' => null
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request)
    {
        $setting = Setting::first();
        $setting->update($request->validated());

        return response()->json([
            'message' => trans('messages.edit'),
        ]);
    }
}
