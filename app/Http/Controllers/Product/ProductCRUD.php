<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Http\Requests\Product\ProductCreate;
use App\Http\Requests\Product\ProductUpdate;
use App\Http\Requests\Product\ProductDelete;
use App\Models\Product\ProductModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductCRUD extends Controller
{
    public function create(ProductModel $productModel,ProductCreate $productCreate)
    {
        $disk = Storage::build([
            'driver' => 'local',
            'root' => storage_path('app/images'),
        ]);


        $validated = $productCreate->validated();
        // return response()->json($validated);

        $name = $validated['name'];
        $text = $validated['text'];

        $preview = $productCreate->file('preview');
        $preview_name = $preview->hashName();
        // $preview_name = uniqid().$preview->getClientOriginalExtension();
        $disk->put($preview_name,file_get_contents($preview));

        $index = $validated['index'];
        $tags = $validated['tags'];
        // $photos = $validated['photos'];
        $info = [
            'seller' => [
                'name' => Auth::user()->seller->company_name,
                'id' => Auth::id()
            ],
            'price' => $validated['info']['price'],
            'sale' => $validated['info']['sale'],
            'count' => $validated['info']['count'],
            'status_sale' => $validated['info']['status_sale']
        ];

        $photos_name = [];
        foreach($productCreate->file('photos') as $photo)
        {
            $photo_name = $photo->hashName();
            $photos_name[] = $photo_name;
            $disk->put($photo_name,file_get_contents($photo));
        };

        $description = [
            'text' => $text,
            'preview' => $preview_name,
            'photos' => $photos_name,
            'index' => $index,
            'tags' => $tags
        ];

        $productModel->name = $name;
        $productModel->description = $description;
        $productModel->info = $info;
        $productModel->save();

        return response()->json(['Status'=>True]);

    }

    public function read(ProductModel $productModel,Request $request)
    {
        if($request->has('seller'))
        {
            $result = $productModel::where('info.seller.id',$request->input('seller'))->get();

            if(!is_null($result))
            {
                return response()->json([$result]);
            }

            return response()->json([]);
        }

        return response()->json([]);
    }

    public function update(ProductModel $productModel,ProductUpdate $productUpdate)
    {
        $disk = Storage::build([
            'driver' => 'local',
            'root' => 'app/images',
        ]);


        $validated = $productUpdate->validated();

        $id = $validated['_id'];

        $old = $productModel::where('_id',$id)->first();

        $disk->delete($old->description->photos);
        $disk->delete($old->description->preview);

        $name = $validated['name'];
        $text = $validated['text'];

        $preview = $validated['preview'];
        $preview_name = $preview->hashName();
        $disk->put($preview_name,file_get_contents($preview));

        $index = $validated['index'];
        $tags = $validated['tags'];
        $photos = $validated['photos'];
        $info = [
            'seller' => [
                'name' => $validated['info.seller.name'],
                'id' => $validated['info.seller.id']
            ],
            'price' => $validated['info.price'],
            'sale' => $validated['info.sale'],
            'count' => $validated['info.count'],
            'status_sale' => $validated['info.status_sale']
        ];

        $photos_name = [];
        foreach($photos as $photo)
        {
            $photo_name = $photo->hashName();
            $photos_name[] = $photo_name;
            $disk->put($photo_name,file_get_contents($photo));
        };

        $description = [
            'text' => $text,
            'preview' => $preview_name,
            'photos' => $photos_name,
            'index' => $index,
            'tags' => $tags
        ];

        $productModel = $productModel::where('_id',$id);
        $productModel->name = $name;
        $productModel->description = $description;
        $productModel->info = $info;
        $productModel->save();

        return response()->json(['Status'=>True]);
    }

    public function delete(ProductModel $productModel,ProductDelete $productDelete)
    {
        $id = $productDelete->validated()['_id'];
        if(!is_null($productModel::where('_id',$id)->get()))
        {
            $productModel::where('_id',$id)->delete();
            return response()->json(['Status'=>True]);
        }

        return response()->json(['Status'=>false]);
    }
}
