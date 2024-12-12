<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\CartModel;
use App\Models\Product\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Customer\Cart\CartCreate;
use App\Http\Requests\Customer\Cart\CartDelete;
use App\Http\Requests\Customer\Cart\CartUpdate;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(CartModel $cartModel,ProductModel $productModel)
    {
        $results = $cartModel::where('user_id',Auth::id())->get();

        return response()->json([$results]);
    }

    public function create(CartCreate $cartCreate,CartModel $cartModel,ProductModel $productModel)
    {
        $validated = $cartCreate->safe()->only(['product_id']);

        $product_id = $validated['product_id'];
        $user_id = Auth::id();
        
        $result = $cartModel::where('user_id',$user_id)->where('product_id',$product_id)->get();


        if(count($result) < 1)
        {
            $product = $productModel::find($product_id);

            $cart = new CartModel;

            $cart->user_id = $user_id;
            $cart->product_id = $product_id;
            $cart->count = 1;
            $cart->product_name = $product['name'];
            $cart->seller_name = $product['info']['seller']['name'];
            $cart->seller_id = $product['info']['seller']['id'];

            $cart->save();

            return response()->json(['I am her']);
        }
        else{
            $count = $cartModel::where('user_id',$user_id)->where('product_id',$product_id)->first()['count'];
            $cartModel::where('user_id',$user_id)->where('product_id',$product_id)->update(['count' => $count+1]);

            return response()->json(["I am her 3"]);
        }

        
    }

    public function read(Request $request,CartModel $cartModel)
    {
        // $id = $request->input('id');

        // $result = [];
        // if(!is_null($id))
        // {
        //     $result = $cartModel::where('_id',$id)->get();
        //     if(!is_null($result))
        //     {
        //         return response()->json($result);
        //     }

        //     return response()->json($result);
        // }
        $result = $cartModel::where('user_id',Auth::id())->with('product')->get(['count','product_id','id','product_name','seller_name','product','seller_id']);

        return response()->json($result);
        // return response($result);
    }

    public function upSet(CartUpdate $cartUpdate,CartModel $cartModel)
    {
        $id = $cartUpdate->safe()->only(["product_id"])['product_id'];
        $count = $cartModel::where('user_id',Auth::id())->where('product_id',$id)->first()['count'];

        $cartModel::where('user_id',Auth::id())->where('product_id',$id)->update(['count' => $count + 1]);
        return response()->json(data: ["Status"=>True]);
    }

    public function downSet(CartUpdate $cartUpdate,CartModel $cartModel)
    {
        $id = $cartUpdate->safe()->only(["product_id"])['product_id'];
        $count = $cartModel::where('user_id',Auth::id())->where('product_id',$id)->first()['count'];
        if($count > 1)
        {
            $cartModel::where('user_id',Auth::id())->where('product_id',$id)->update(['count' => $count - 1]);
        }
        else
        {
            $cartModel::where('user_id',Auth::id())->where('product_id',$id)->delete();
        }
        return response()->json(data: ["Status"=>True]);
    }

    public function delete(CartDelete $cartDelete,CartModel $cartModel)
    {
        $id = $cartDelete->safe()->only(["product_id"])['product_id'];

        $cartModel::where('user_id',Auth::id())->where('product_id',$id)->delete();

        return response()->json(data: ["Status"=>True]);
    }

    public function check_cart(CartModel $cartModel,Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([]);
        }

        $id = $validator->safe()->only(['product_id'])['product_id'];

        if(Auth::check())
        {
            // $result = $cartModel::where(column: 'products',['product_id' => $id])->first();
            $result = $cartModel::where('user_id',Auth::id())->where('product_id',$id)->first();
            
            if(!is_null($result))
            {
                return response()->json(['count'=>$result['count'],'product_id'=>$result['product_id']]);
            }

            return response()->json([]);
        }
        else
        {
            return response()->json([]);
        }
    }
}
