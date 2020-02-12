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
        $user = User::find($request->user()->id);

        return response()->json($user);
    }

    public function update(){

    }
}
