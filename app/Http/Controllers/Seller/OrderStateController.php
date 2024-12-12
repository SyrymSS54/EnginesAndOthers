<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Customer\CartModel;
use Illuminate\Http\Request;
use App\Models\Customer\OrderModel;
use App\Models\Seller\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class OrderStateController extends Controller
{
    public function get_orders(OrderModel $orderModel,Request $request)
    {
        $result = $orderModel::where('seller_id',Auth::id())->get(['created_at','order_id','products','state','id']);

        return response()->json($result);
    }
    
    public function order_for_consideration(OrderModel $orderModel,CartModel $cartModel,Request $request)
    {
        $validator = Validator::make($request->all(),[
            "id" => "required|string"
        ]);

        if($validator->fails()){
            return response()->json([]);
        }

        $validated = $validator->safe()->only(['id']);

        $products = $orderModel::where('seller_id',Auth::id())->where('_id',$validated['id'])->first(['products']);

        if(is_null($products))
        {
            return response()->json(['status'=>False]);
        }

        // dd($products->getAttributes()['products']);
        foreach($products->getAttributes()['products'] as $product)
        {
            // dd($product);
            $id = $product['description']['id'];
            $count = $product['count']; //количество предметов
            // dd([$id,$count]);

            $store = Store::where('product',$id)->first(['count']); // количество продукта

            if(is_null($store))
            {
                return response()->json(['status'=>false]);
            }
            else
            {
                $result = $store['count'];
            }

            // dd(vars: $count,$store,$result);
            if($count <= $result)
            {
                $records = Store::where('product',$id)->first(['records'])['records'];
                $records[] = [["id"=>uniqid(),'time'=>date('Y-m-d'),"count"=>(int)$count,'oper'=>'Расход']];
                Store::where('product',$id)->update(['count' => $result-$count,'records'=>$records]);
            }
            else{
                return response()->json(['status'=>false]);
            }
        }

        $orderModel::where('seller_id',Auth::id())->where('_id',$validated['id'])->where('state',1)->update(['state'=>2]);
        return response()->json(['status'=>True]);
    }

    public function order_for_execution(OrderModel $orderModel,Request $request)
    {
        $validator = Validator::make($request->all(),[
            "id" => "required|string"
        ]);

        if($validator->fails()){
            return response()->json([]);
        }

        $validated = $validator->safe()->only(['id']);

        $result = $orderModel::where('seller_id',Auth::id())->where('_id',$validated['id'])->where('state',2)->update(['state'=>3]);
        return response()->json(['status'=>True]);
    }

    public function order_on_cancellation(OrderModel $orderModel,Request $request)
    {
        $validator = Validator::make($request->all(),[
            "id" => "required|string"
        ]);

        if($validator->fails()){
            return response()->json([]);
        }

        $validated = $validator->safe()->only(['id']);

        $result = $orderModel::where('seller_id',Auth::id())->where('_id',$validated['id'])->update(['state'=>4]);
        return response()->json(['status'=>True]);
    }

    public function history(OrderModel $orderModel)
    {
        return response()->json($orderModel::where('user_id',Auth::id())->where('state',3)->orWhere('state',4)->get());
    }
}
