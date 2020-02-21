<?php

namespace App\Http\Controllers\API;

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
        if ($user->role_id == 4) {
            $userfinal = array([
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'active' => $user->active,
                'role' => $user->role->role,
                'company' => User::find($user->company)->name,
            ]);
        } else {
            $userfinal = [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'active' => $user->active,
                'role' => $user->role->role,
            ];
        }

        return response()->json($userfinal);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string | max:60',
            'phone' => 'regex:/^(05)[0-9]{8}$/'
        ]);

        $name = $request->name;
        $phone = $request->phone;
        if ($name != null || $phone != null) {
            if ($name != null) {
                User::where('id', '=', $request->user()->id)->update(['name' => $name]);
            }
            if ($phone != null) {
                User::where('id', '=', $request->user()->id)->update(['phone' => $phone]);
            }
            return response()->json([
                'message' => 'Successfully updated user'
            ], 200);
        }
        return response()->json([
            'message' => 'Nothing to update'
        ], 400);
    }
}
