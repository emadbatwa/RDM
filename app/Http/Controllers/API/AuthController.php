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
    public function register(Request $request)
    {
        $request->validate([
//            'name' => 'required|string',
//            'phone' => 'regex:/(05)[0-9]{8}/',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

            $user = User::create([
//                'name' => $request->name,
//                'phone' => $request->has('phone') ? $request->phone: null,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

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
        $userinfo = User::with('role')->where('id', '=', $request->user()->id)->first();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user_data' => $userinfo
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
