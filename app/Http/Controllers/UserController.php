<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

//use App\Http\Controllers\BaseController;
class UserController extends BaseController
{


    public function index()
    {
        User::query()->get();
        return "Users";

    }

    public function store(Request $request)
    {
        $rules = $this->getRouler();
        $input = $request->all();
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return $this->SendError('please Validate error', $validator->errors());
        }

        $input['password'] = Hash::make($input['password']);
        $user = user::query()->create($input);
        $success['token'] = $user->createToken('khader')->accessToken;
        $success['name'] = $user->name;
        $user->save();
        return $this->SendResponse($success, "User Registered Successfully");

    }

    public function getRouler()
    {
        return $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:users'],//required|max:30|unique:Product,name
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'max:255', 'numeric']
        ];
    }

    public function show($id)
    {
        $user = User::query()->find($id);
        if (is_null($user)) {
            return $this->SendError('User not found');
        }
        return 'User found succesfully';
    }

    public function update(Request $request, User $user)
    {

        $input = $request->all();
        $reules = $this->getRouler();
        $validator = Validator::make($input, $reules);
        if ($validator->fails()) {
            return $this->SendError('please Validate error', $validator->errors());
        }
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = $input['password'];
        $user->profile = $input['profile'];
        $user->Facebook = $input['Facebook'];
        $user->WhatsApp = $input['WhatsApp'];
        $user->mobilePhone = $input['mobilePhone'];
        return "User Update Successfully";
    }

    public function destroy(User $user)
    {
        $user->delete($user);
    }
}
