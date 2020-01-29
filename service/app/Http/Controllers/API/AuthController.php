<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Storage;


/**
 * Class AuthController
 * @group user, login/register System
 * @package App\Http\Controllers\API
 */
class AuthController extends Controller
{

    /**
     * register a user
     *
     * User will enter the information required for register
     *
     * @bodyParam name string required The Name of the user Example: mohammed alghamdi
     * @bodyParam phone_number string required The Phone Number of the user 10 digits (There is a check that the string is number). Example: 0555555555
     * @bodyParam email string required The Email of the user. Example: mohammed@hotmail.com
     * @bodyParam password string required The password of the user. Example: password
     * @bodyParam password_confirmation string required The password of the user. Example: password
     * @bodyParam role string required The Role of the user. Example: USER
     *
     *
     * @response 201 {
     * "message": "Successfully created user!"
     * }
     *
     * @response 422 {
     * "message": "The given data was invalid.",
     * "errors": {
     * "password": [
     * "The password field is required."
     *   ]
     *  }
     * }
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|regex:/(05)[0-9]{8}/',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'activation_token' => str_random(60),
            ]);
            //$user->notify(new registerActivate($user));

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user_data' => $user
        ]);
    }

    /**
     * login a user
     *
     * User will Enter credentials and the api route will return The user details with the token.
     * if its wrong it will return all errors.
     *
     * @bodyParam email string required The Email of the user. Example: user@hotmail.com
     * @bodyParam password string required The Password of the user. Example: password
     * @bodyParam remember_me boolean For Remember Token (adds week to the token).
     *
     * @response 200 {
     * "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImEwNjYzOThhMjU2OTQ5MWRiMDU4ZDg1YmVhZmY4MTQ2MTc1MTFkOTcyYWFjNmNmNTUzOTdkMzU1ZjcyNGYyYTI4MDQzNjBlZWJjNWQ5NzNhIn0.eyJhdWQiOiIxIiwianRpIjoiYTA2NjM5OGEyNTY5NDkxZGIwNThkODViZWFmZjgxNDYxNzUxMWQ5NzJhYWM2Y2Y1NTM5N2QzNTVmNzI0ZjJhMjgwNDM2MGVlYmM1ZDk3M2EiLCJpYXQiOjE1NjI1NzUwODUsIm5iZiI6MTU2MjU3NTA4NSwiZXhwIjoxNTk0MTk3NDg1LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.jKYeP3Q8So0vfeFBHbc4mOuKVmMrmj_jc9x8rjz8FBzqYR1t0p9Sbcraq1C2IAPiP59jNmeDdeD_tH-c1lfTxWVvJswq4CHC2T6BHmk4FgXvTuAs7fcrt3NEkPJQOG7-ePy_b_7fCh6t1lEOjn9RBQlbTyCnx0IfloeahV58RG5fbKFkNQ4ca0hSPvivrEm0FqUBEh2WDfqIufiMWsCjTbF2FUYzzKXcuqlJpTw17Ndbz2E76oH_mJu2K6a9KCawYBcwEHHdfPpZZNeqMRZp28rVAp5bASuVTQxSFlDqu8eQwpa1gRn8p0Y14zFtHjTiGm-CWQHS-r9moXQ_2an5exYjfUNY_39S5X5xaLi5QB8zY-W_uH8fjg2hQKekZda9RN9ddYIQeuS50IxVqVFMFlWTUYpF7MvzORr-qftlTGCW7L4aQ8mfEH2-OKVpJ3ONVjW9sdHtKLzIh-3gKDPRtanE0sEiALKI7uCR-SMg5ibW06GN67QEpghpSM1p4I1iGrdVy9ndGYwbLow5GHYQM-jVLHhRLqcfhDoynoqs-ngzSPCo8d5QrgIqY7z2sfgtRVtpb154Yk9t4waG0y2xpoyChv1ehA2NJgPooK-KT0sAoTsl1CL-LjdxfPI9-WpW7qZPj87PDW7_Q56NY7E7tqlXb3eqZrZqrJkVrcEo8tA",
     * "token_type": "Bearer",
     * "expires_at": "2019-07-15 08:38:05",
     * "user_data": {
     * "user_id": 3,
     * "name": "user",
     * "phone_number": "0000000002",
     * "email": "user@hotmail.com",
     * "email_verified_at": null,
     * "role": "USER",
     * "created_at": null,
     * "updated_at": null
     * }
     *}
     *
     * @response 401 {
     *  "message": "Unauthorized"
     * }
     *
     * @response 422 {
     * "message": "The given data was invalid.",
     * "errors": {
     * "password": [
     * "The password field is required."
     *   ]
     *  }
     * }
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user_data' => $user
        ]);
    }


    /**
     * logout a user or boutique
     *
     * logout a user if is login (require token)
     *
     * @authenticated
     * @bodyParam token string required Token of the user you want to logged it out
     *
     * @response 200 {
     *  "message": "Successfully logged out"
     * }
     *
     * @response 401 {
     * "message": "Unauthenticated."
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
