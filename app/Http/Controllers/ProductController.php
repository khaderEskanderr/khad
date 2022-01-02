<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Events\Viewer;
use App\Models\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Product as ProductResources;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;

class ProductController extends BaseController
{


    public function index()
    {
        $product = Product::all();
        return $this->SendResponse(ProductResources::collection($product), 'All Products Successfully');
    }

    public function store(Request $request)
    {
        //save photo
        $file_extension = $request->image_url->getClientOrignalExtenion();
        $file_name = time() . "." . $file_extension;
        $request->image_url->move($file_name);
        //

        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required', //|max:30|unique:products,name
            'description' => 'required',
            'user_id' => 'required',
            'name' => 'required|max:30|unique:Product,name',
            'quntity' => 'required|nueric',
            'prices' => 'required|numeric',
            'image_url' => 'required',
            'cate_id' => 'required',
            'exp_data' => 'required',
            'creat_up' => 'required',
            'update_up' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->SendError('plase Validate error', $validator->errors());
        }

        $user = Auth::user();
        $input['user_id'] = $user->id;
        $product = Product::create($input);
        return $this->SendResponse($product, "Product Stored Successfully");
    }


    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->SendError('Product not found');
        }
        return $this->SendResponse(new ProductResources($product), "Product found Successfully");
    }


    public function update(Request $request, Product $product)
    {


        $input = $request->all();
        $rules = $this->getRouler();
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return $this->SendError('Product not found!', $validator->errors());
        }
        $product->name = $input['name'];
        $product->image_url = $input['image_url'];
        $product->description = $input['description'];
        $product->prices = $input['prices'];
        $product->quantity = $input['quantity'];
        $product->cate_id = $input['cate_id'];
        $product->price_offer = $input['price_offer'];
        $product->creat_up = $input['creat_up'];
        $product->update_up = $input['update_up'];
        $product->save();
        return $this->SendResponse(new ProductResources($product), "Product updated Successfully");
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->SendResponse(new ProductResources($product), "Product delete Successfully");
    }

    public function getView()
    {
        $veiw = View::first();
        event(new Viewer($veiw));
        return $veiw;
    }

    public function price()
    {
        $carbon = Carbon::now();
        $products = Product::all();
        foreach ($products as $product) {
            $price = $product ['price'];
            $end = Carbon::parse($product['Ex']);
            $day = $end->diffInDays($carbon) + 1;
            if ($day == 31) {
                $price_of = $price - ($price * 30) / 100;
                $product->price_offer = $price_of;
                $product->save();
            } elseif ($day < 31 && $day >= 15) {
                $price_of = $price - ($price * 50) / 100;
                $product->price_offer = $price_of;
                $product->save();
            }
        }
    }

    public function search(Request $request)
    {
        $product_found = Product::query();
        if ($serch = $request->input('ser')) {
            $product_found->whereRaw("name Like" . $serch . "%")
                ->orwhereRaw("type Like" . $serch . "%")
                ->orwhereRaw("Ex Like" . $serch . "%");
        }
        return $product_found->get();
    }
}
