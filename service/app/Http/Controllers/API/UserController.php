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

    /**
     *authenticated User
     *
     * return the data of authenticated User
     *
     * @authenticated
     *
     * @queryParam token string required Token for the logged in user to get its info.
     *
     * @response 200 {
     * "user_id": 2,
     * "name": "boutique",
     * "phone_number": "000000001",
     * "email": "boutique@hotmail.com",
     * "email_verified_at": null,
     * "password": "$2y$10$HMoWcgIrnnUpd2djzE9hFOqWPIYQu7S.1AG27gtrVYwn3JYrl5bkq",
     * "role": "BOUTIQUE",
     * "created_at": null,
     * "updated_at": null,
     * "boutique": {
     * "boutique_id": 1,
     * "user_id": 2,
     * "boutique_name": "comon man",
     * "description": "fwkefjwef",
     * "designer": "واحد كويس",
     * "brand": "ماركة غالية",
     * "created_at": null,
     * "updated_at": null
     * },
     * "addresses": [
     * {
     * "address_id": 2,
     * "city": "jeddah",
     * "address": "home32",
     * "default": 1,
     * "user_id": 2,
     * "created_at": null,
     * "updated_at": null
     * },
     * {
     * "address_id": 4,
     * "city": "riyadh",
     * "address": "home",
     * "default": 0,
     * "user_id": 2,
     * "created_at": null,
     * "updated_at": null
     *   }
     *  ]
     * }
     *
     * @response 401 {
     *  "message": "Unauthenticated."
     * }
     * @return [json] user object
     */
    public function userInfo(Request $request)
    {
        $user = User::find($request->user()->user_id)->load('boutique', 'addresses');

        return response()->json($user);
    }


    /**
     * Update user info
     *
     * Update user info and require auth token
     *
     * @param Request $request
     * @authenticated
     *
     * @bodyParam name string required The Name of the user Example: mohammed alghamdi
     * @bodyParam phone_number string required The Phone Number of the user 10 digits (There is a check that the string is number). Example: 0d555555555
     * @bodyParam email string required The Email of the user. Example: mohsammed@hotmail.com
     * @bodyParam role string required The Role of the user. Example: BOUTIQUE
     * @bodyParam boutique_name string required The boutique name of the boutique. Example: محل الخيال
     * @bodyParam description string The description for the boutique. Example: محلنا يقدم افضل الملابس
     * @bodyParam brand string The brand of the boutique. Example: ماركمة أ
     * @bodyParam designer string The designer name of the boutique. Example: المصمم فلان الفلاني
     *
     * @response 200{
     * "message": "Successfully updated user!"
     * }
     *
     * @response 401 {
     * "message": "Unauthenticated."
     * }
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Update a user address
     *
     * update city and address of the user token is required
     *
     * @authenticated
     * @bodyParam address_id string required The City of the user. Example: 1
     * @bodyParam city string required The City of the user. Example: makkah
     * @bodyParam address string required The address of the user. Example: شارع العسكر بجوار مخبز حمادة
     *
     * @response 200 {
     *  "message": "Successfully updated address!"
     * }
     *
     * @response 401 {
     *  "message": "unauthorized user"
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Store a new address
     *
     * Store a new address for the logged in user
     * @authenticated
     *
     * @bodyParam city string required The City of the user. Example: makkah
     * @bodyParam address string required The address of the user. Example: شارع العسكر بجوار مخبز حمادة
     *
     * @response 201 {
     *  "message": "Successfully added address!"
     * }
     *
     * @response 401 {
     *  "message": "Unauthenticated."
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
