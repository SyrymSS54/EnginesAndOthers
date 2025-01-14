<?php

namespace App\Models\Customer;

use App\Models\Product\ProductModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'cart';

    protected $guards =[];

    public function product()
    {
        return $this->belongsTo(ProductModel::class,'product_id','_id');
    }
}
