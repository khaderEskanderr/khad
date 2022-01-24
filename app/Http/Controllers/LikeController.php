<?php

namespace App\Http\Controllers;

use App\Http\Resources\View as ViewResources;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class LikeController extends BaseController
{

    public function index(Request $request, Product $product)
    {
        $likes = $product->view()->get();
        return response()->json($likes);
    }

    public function store(Request $request, Product $product)
    {

        $exists = Like::query()
            ->where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            Like::query()->where('user_id', Auth::id())->delete();
        } else {
            $product->likes()->create([
                'product_id' => $request->product_id,
                'user_id' => Auth::id()
            ]);
        }
        return response()->json(null);

    }

    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->SendError('Product not found');
        }
        return $this->SendResponse($product, "View found Successfully");
    }


    public function update(Request $request, Like $like)
    {
        $input = $request->all();
        $like->user_id = $input['user_id'];
        $like->product_id = $input['product_id'];
        $like->creat_up = $input['creat_up'];
        $like->update_up = $input['update_up'];
    }


    public function destroy(Like $like)
    {
        $like->delete();
        return $this->SendResponse($like, 'likes delete Successfully');
    }
}
