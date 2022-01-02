<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        category::query()->get();
        return "category";
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, ['id', 'name']);
        if ($validator->fails()) {
            return $this->SendError('palce Validate error', $validator->errors());
        }
        category::query()->create([
            'name' => $request->name,
            'id' => $request->id
        ]);
        return "Saved Successfully";
    }

    public function show($id)
    {
        $category = Category::query()->find($id);
        if (is_null($category)) {
            return $this->SendError('category not found');
        }
        return 'category found succesfully';
    }

    public function update(Request $request, Category $category)
    {
        $input = $request->all();
        $validator = Validator::make($input, ['id', 'name']);
        if ($validator->fails()) {
            return $this->SendError('palse Validate error', $validator->errors());
        }
        $category->name = $input['name'];
        return "category update succesfully";
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return "category delete successfully";
    }
}
