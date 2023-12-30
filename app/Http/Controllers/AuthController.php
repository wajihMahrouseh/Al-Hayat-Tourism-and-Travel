<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LogInRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;

class AuthController extends Controller
{
    public function login(LogInRequest $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => trans('messages.incorrectCredentials')
            ], 422);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        // if (Auth::attempt($request->only('email', 'password'))) {
        //     $user = Auth::user();
        //     $token = $user->createToken($request->device_name)->plainTextToken;

        //     return response()->json(['token' => $token], 200);
        // }

        return response()->json([
            'token' => $token
        ], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => trans('messages.loggedOutSuccessfully')
        ], 200);
    }


    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        $user->update($request->validated());
        return response()->json([
            'message' => trans('messages.passwordChangedSuccessfully')
        ], 200);
    }
}
