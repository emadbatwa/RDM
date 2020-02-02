<?php

namespace App\Http\Controllers\API;

use App\Address;
use App\Notifications\PasswordResetSuccess;
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
        $user = User::find($request->user()->user_id)->load('boutique', 'addresses');

        return response()->json($user);
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|string|email',
            'role' => 'required|in:USER,BOUTIQUE'
        ]);
        try {
            $user = $request->user();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'No user with this id found'
            ], 403);
        }

        if ($request->role == User::USER_ROLE) {
            $user->name = $request->get('name');
            $user->phone_number = $request->get('phone_number');
            $user->email = $request->get('email');
            $user->save();
        }

        if ($request->role == User::BOUTIQUE_ROLE) {
            $request->validate([
                'boutique.boutique_name' => 'required|string',
                'boutique.description' => 'required|string',
            ]);

            $user->name = $request->get('name');
            $user->phone_number = $request->get('phone_number');
            $user->email = $request->get('email');
            $user->role = User::BOUTIQUE_ROLE;
            $user->save();

            $user->boutique->boutique_name = $request->get('boutique_name');
            $user->boutique->description = $request->get('description');

        }

        return response()->json([
            'message' => 'Successfully updated user!'
        ], 200);
    }

    public function updateAddress(Request $request)
    {
        $address = Address::findOrFail($request->get('address_id'));
        if ($address->user_id == $request->user()->user_id) {
            $request->validate([
                'city' => 'required|string',
                'address' => 'required|string'
            ]);
            $address->city = $request->get('city');
            $address->address = $request->get('address');
            $address->save();

            return response()->json([
                'message' => 'Successfully updated address!'
            ], 200);
        }
        return response()->json([
            'message' => 'unauthorized user'
        ], 401);
    }

    public function storeAddress(Request $request)
    {
        $address = new Address();
        $request->validate([
            'city' => 'required|string',
            'address' => 'required|string',
            'default' => 'required|in:0'
        ]);
        $address->city = $request->get('city');
        $address->address = $request->get('address');
        $address->default = $request->get('default');
        $address->user_id = $request->user()->user_id;
        $address->save();

        return response()->json([
            'message' => 'Successfully added address!'
        ], 201);
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'newPassword' => 'required|string|confirmed',
        ]);
        if(password_verify($request->get('password'), $request->user()->password)){
            $request->user()->update([
                'password' => bcrypt($request->get('newPassword')),
            ]);
            return response()->json([
                'message' => 'Successfully added address!'
            ], 201);
            $request->user()->notify(new PasswordResetSuccess($request->user()));
        }
        return response()->json([
            'message' => 'The password is not correct'
        ], 422);
    }
}
