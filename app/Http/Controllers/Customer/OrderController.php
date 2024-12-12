<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\CartModel;
use App\Models\Customer\OrderModel;
use App\Models\Product\ProductModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function read(Request $request)
    {
        if($request->has('id'))
        {
            $validator = Validator::make($request->all(),[
                "id" => 'required|string'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
    
            $id = $validator->safe()->only(['id'])['id'];

            return response()->json(OrderModel::where('user_id',Auth::id())->where('order_id',$id)->first(['order_id','products','seller_name','state']));
        }
        $result = OrderModel::where('user_id',Auth::id())->whereNot('state',3)->whereNot('state',4)->get();
        return response()->json($result);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'seller_name' => 'required|string',
            'seller_id' => 'required|numeric',
            'products.*.product_id' => 'required|string',
            'products.*.count' => 'required|numeric',
            'products.*.id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $credentials = $validator->safe()->only(['seller_id','seller_name','products']);


        $order = new OrderModel;

        $order->seller_name = $credentials['seller_name'];
        $order->seller_id = $credentials['seller_id'];
        $order->order_id = uniqid();
        $order->user_id = Auth::id();
        $order->state = 0;

        $products = [];
        foreach($credentials['products'] as $product){
            $product_description = ProductModel::where('_id',$product['product_id'])->first(['_id','product_id','name','description','info']);
            $products[] = ['count' => $product['count'],"description" => $product_description->attributesToArray()];
        }
        $order->products = $products;

        $order->save();

        foreach($credentials['products'] as $product){
            CartModel::where('_id',operator: $product['id'])->delete();
        }

        return response()->json('Ok');
    }

    public function pay(Request $request,OrderModel $orderModel)
    {
        $validator = Validator::make($request->all(),[
            "id" => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $id = $validator->safe()->only(['id'])['id'];

        $orderModel::where('user_id',Auth::id())->where('order_id',$id)->update(['state'=>1]);

        return response()->json(['stauts'=>True]);
    }

    public function history(OrderModel $orderModel)
    {
        return response()->json($orderModel::where('user_id',Auth::id())->where(function($query){
            $query->where('state',3)->orWhere('state',4);
        })->get());
    }
}
