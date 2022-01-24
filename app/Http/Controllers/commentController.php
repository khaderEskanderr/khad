<?php

namespace App\Http\Controllers;

use App\Http\Resources\View as ViewResources;
use App\Models\comment;
use App\Models\Product;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commentController extends BaseController
{

    public function index(Request $request, Product $product)
    {
        $comments = $product->view()->get();
        return response()->json($comments);
    }


    public function store(Request $request, Product $product)
    {
        $request->validate([
            'value' => ['required', 'string', 'min:1', 'max:400']
        ]);

        $comment = $product->comment()->create([
            'value' => $request->value,
            'user_id' => Auth::id()
        ]);

        return response()->json($comment);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->SendError('Product not found');
        }
        return $this->SendResponse($product, "Comment found Successfully");
    }

    public function update(Request $request, comment $comment)
    {
        $input = $request->all();
        $comment->user_id = $input['user_id'];
        $comment->product_id = $input['product_id'];
        $comment->value = $input['value'];
        $comment->creat_up = $input['creat_up'];
        $comment->update_up = $input['update_up'];
    }

    public function destroy(comment $comment)
    {
        $comment->delete();
        return $this->SendResponse($comment, "comment delete Successfully");

    }
}
