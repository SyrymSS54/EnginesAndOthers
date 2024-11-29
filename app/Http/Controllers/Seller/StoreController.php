<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\CreateStore;
use App\Http\Requests\Seller\StoreItem;
use Illuminate\Http\Request;
use App\Models\Seller\Store;
use Illuminate\Support\Facades\Auth;
use App\Models\Product\ProductModel;

class StoreController extends Controller
{
    public function get_list_store(Store $store,Request $request)
    {
        return response()->json();
    }

    public function create_store(Store $store,CreateStore $request)
    {
        $validated = $request->safe()->only(['time','product','oper','count']);


        $check = $store::where('seller_id',Auth::id())->where('product',$validated['product'])->first();


        if(!is_null($check))
        {
            $records = $check['records'];
            $records[] = ["id"=>uniqid(),'time'=>$validated['time'],"count"=>(int)$validated['count'],'oper'=>$validated['oper']];

            if($validated['oper']=="Приход")
            {
                $count = $check['count'] + $validated['count'];
            }
            else{
                $count = $check['count'] - $validated['count'];
            }

            $store::where('seller_id',Auth::id())->where('product',$validated['product'])->update(['records'=>$records,'count'=>$count]);

            return response()->json('Ok');

        }
        else
        {
            $store = new Store;

            $store->seller_id = Auth::id();
            $store->product = $validated['product'];
            if($validated['oper']=="Приход"){
                $store->count = (int)$validated['count'];
            }
            else{
                $store->count = -(int)$validated['count'];
            }
            $store->records = [["id"=>uniqid(),'time'=>$validated['time'],"count"=>(int)$validated['count'],'oper'=>$validated['oper']]];

            $store->save();

            return response()->json("Ok");
        }

    }

    public function get_item_store(Store $store,ProductModel $productModel,StoreItem $request)
    {
        $validated = $request->safe()->only(['product']);
        
        $result = $store::where('seller_id',Auth::id())->where('product',$validated['product'])->first();
        // return response()->json($result);
        $result['name'] = $productModel::where("_id",$validated['product'])->first(['name'])['name'];

        return response()->json($result);
    }

    public function get_list_product(ProductModel $productModel,Request $request)
    {
        $results = $productModel::where('info.seller.id',Auth::id())->get(['id','name']);

        return response()->json($results);
    }
}
