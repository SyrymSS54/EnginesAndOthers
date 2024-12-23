<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\ProductModel;

class ProductController extends Controller
{
    public function index(ProductModel $productModel,Request $request)
    {
        if($request->has('id'))
        {
            $id = $request->input('id');
            
            $result = $productModel::where('_id',$id)->first();
            if(!is_null($result))
            {
                return view('product.card',$result);
            }

            return response()->json(['Status' => false]);
        }

        return response()->json(['Status'=>'Not id']);
    }

    public function search(ProductModel $productModel,Request $request)
    {
        if($request->has('query'))
        {
            $query = $request->input('query');
            $query = '%'.$query.'%';

            $search_name = $productModel::where('name','like',$query)->get();
            $search_text = $productModel::where('description.text','like',$query)->get();
            $search_tags = $productModel::where('description.tags','like',$query)->get();
            $search_seller = $productModel::where('info.seller.name','like',$query)->get();

            if(is_null($search_name) && is_null($search_text) && is_null($search_tags) && is_null($search_seller))
            {
                return response()->json(['Status' => 'Not Search']);
            }

            return view('product.search',['name'=>$search_name,'text'=>$search_text,'tags'=>$search_tags,'seller'=>$search_seller]);
        }

        return response()->json(['Status'=>'Not query']);
    }

    public function get_item(ProductModel $productModel,Request $request)
    {
        if($request->has('id'))
        {
            $id = $request->input('id');
            
            $result = $productModel::where('_id',$id)->first();
            if(!is_null($result))
            {
                return response()->json(['result' => $result,'Status'=>true]);
            }

            return response()->json(['Status' => false]);
        }

        return response()->json(['Status'=>false]);
    }

    public function get_search(ProductModel $productModel,Request $request)
    {
        if($request->has('query'))
        {
            $query = $request->input('query');

            if($query == '')
            {
                return response()->json(['Status'=>false]);
            }

            $query = '%'.$query.'%';

            $search_name = $productModel::where('name','like',$query)->get();
            $search_text = $productModel::where('description.text','like',$query)->get();
            $search_tags = $productModel::where('description.tags','like',$query)->get();
            $search_seller = $productModel::where('info.seller.name','like',$query)->get();

            if(is_null($search_name) && is_null($search_text) && is_null($search_tags) && is_null($search_seller))
            {
                return response()->json(['Status' => false]);
            }

            return response()->json(['Status' => true,'name'=>$search_name,'text'=>$search_text,'tags'=>$search_tags,'seller'=>$search_seller]);
        }

        return response()->json(['Status'=>false]);
    }

    public function index_list(ProductModel $productModel,Request $request)
    {
        if($request->has('tag'))
        {
            $tag = $request->input('tag');
            $tag = '%'.$tag.'%';

            $result = $productModel::where('description.tags','like',$tag)->get();
            if(!is_null($result))
            {
                return response()->json(['tag'=>$tag,'result'=>$result]);
            }
        }
        elseif($request->has('seller'))
        {
            $seller = $request->input('seller');
            $seller = '%'.$seller.'%';

            $result = $productModel::where('info.seller.name','like',$seller)->get();
            if(!is_null($result))
            {
                return response()->json(['seller'=>$seller,'result' => $result]);
            }
        }

        return response()->json(['Status'=>"Not list"]);
    }
}
