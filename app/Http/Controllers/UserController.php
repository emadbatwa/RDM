<?php

namespace App\Http\Controllers;

use App\City;
use App\Neighborhood;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function employees(Request $request)
    {
        if (\Auth::user()->role_id == 3) {
            $employees = User::where('company', '=', \Auth::user()->id)->get();
            return view('company.employees')->with(['employees' => $employees]);
        } else {
            return redirect()->back();
        }
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
        return $this->employees($request);
    }
}
