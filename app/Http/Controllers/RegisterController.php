<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController as BaseController;

class RegisterController extends BaseController
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required', //|max:30|unique:users,name
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return $this->SendError('plase Validate error', $validator->errors());
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input); //Error
        $success['name'] = $user->name;
        $success['token'] = $user->createToken('khaderEskander')->accessToken;
        return $this->SendResponse($success, "User Registered Successfully");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->SendError('plase Validate error', $validator->errors());
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input); //Error
        $success['name'] = $user->name;
        $success['token'] = $user->createToken('khaderEskander')->accessToken;
        return $this->SendResponse($success, "User login Successfully");
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->SendResponse(" ", "User logout Successfully");
    }
}
