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
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required', //|max:30|unique:users,name
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->SendError('plase Validate error', $validator->errors());
        } else {
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),

            ]); //Error
            if ($user){
                $success['token'] = 'murad';
                $success['name'] = $user->name;


                return $this->SendResponse($success, "User Registered Successfully");

            }
            return $this->SendError('plase Validate error', $validator->errors());

//            die(var_dump($user));
        }

        //return "test";


    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('khaderEskander'); //createToken('khaderEskander')->accessToken
            //$success['name'] = $user->name;
            return $this->SendResponse($success, "User login Successfully");
        } else {
            return $this->SendError('Unauthorised', ['error', 'Unauthorised']);
        }
    }


}
