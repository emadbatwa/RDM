<?php

namespace App\Http\Controllers\API;

use App\City;
use App\Neighborhood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Mail;

/**
 * Class UserController
 * @group user, login/register System
 * @package App\Http\Controllers\API
 */
class UserController extends Controller
{

    public function userInfo(Request $request)
    {
        $user = User::find($request->user()->id)->load('role');
        $city = City::find($request->user()->city_id);
        $neighborhood = Neighborhood::find($request->user()->neighborhood_id);
        if ($user->role_id == 4) {
            $userfinal = [
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'active' => $user->active,
                'role' => $user->role->role,
                'role_ar' => $user->role->role_ar,
                'gender' => $user->gender,
                'company' => User::find($user->company)->name,
                'city' => $city,
                'neighborhood' => $neighborhood,
            ];
        } else {
            $userfinal = [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'active' => $user->active,
                'role' => $user->role->role,
                'role_ar' => $user->role->role_ar,
                'gender' => $user->gender,
                'city' => $city,
                'neighborhood' => $neighborhood,
            ];
        }

        return response()->json($userfinal);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string | max:60',
            'phone' => 'regex:/^(05)[0-9]{8}$/',
            'city' => 'numeric| in:6',
            'neighborhood' => 'numeric| between:3377,3437',
            'gender' => 'in:MALE,FEMALE'
        ]);

        $name = $request->name;
        $phone = $request->phone;
        $gender = $request->gender;
        $city = $request->city;
        $neighborhood = $request->neighborhood;
        if ($name != null || $phone != null || $gender != null || $city || null || $neighborhood != null) {
            if ($name != null) {
                User::where('id', '=', $request->user()->id)->update(['name' => $name]);
            }
            if ($phone != null) {
                User::where('id', '=', $request->user()->id)->update(['phone' => $phone]);
            }
            if ($gender != null) {
                User::where('id', '=', $request->user()->id)->update(['gender' => $gender]);
            }
            if ($city != null) {
                User::where('id', '=', $request->user()->id)->update(['city_id' => $city]);
            }
            if ($neighborhood != null) {
                User::where('id', '=', $request->user()->id)->update(['neighborhood_id' => $neighborhood]);
            }
            $user = User::where('id', '=', $request->user()->id)->first();
            $userCity = City::where('id', '=', $user->city_id)->first();
            $userNeighborhood = Neighborhood::where('id', '=', $user->neighborhood_id)->first();
            return response()->json([
                'message' => 'Successfully updated user',
                'user_info' => $user,
                'city' => $userCity,
                'neighborhood' => $userNeighborhood,
            ], 200);
        }
        return response()->json([
            'message' => 'Nothing to update'
        ], 400);
    }
}
