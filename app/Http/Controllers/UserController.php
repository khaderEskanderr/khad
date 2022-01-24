<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Product as ProductResources;

class UserController extends BaseController
{


    public function index()
    {
        $user = User::all();
        return $this->SendResponse(ProductResources::collection($user), 'All users Successfully');
    }

    public function store(Request $request)
    {
        $rules = $this->getRouler();
        $input = $request->all();
        $validator = Validator::make($input->all(), $rules);
        if ($validator->fails()) {
            return $this->SendError('please Validate error', $validator->errors());
        }
        $user = User::create($input);
        $user->save();
        return $this->SendResponse($user, "User Registered Successfully");
    }

    public function getRouler()
    {
        return $rules = [
            'name' => ['required', 'string', 'unique:users'], //required|max:30|unique:Product,name
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'numeric']
        ];
    }

    public function show($id)
    {
        $user = User::query()->find($id);
        if (is_null($user)) {
            return $this->SendError('User not found');
        }
        return $this->SendResponse(new ProductResources($user), "User found Successfully");
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
        $user->mobilePhone = $input['mobilePhone'];
        $user->save();
        return $this->SendResponse(new ProductResources($user), "User updated Successfully");
    }

    public function destroy(User $user)
    {
        $user->delete($user);
        return $this->SendResponse(new ProductResources($user), "User delete Successfully");
    }
}
