<?php

namespace App\Models\Customer;

use App\Models\Product\ProductModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'order';
    protected $guards =[];

    public function product()
    {
        return $this->embedsmany(ProductModel::class,'products.*.product_id','_id');
    }
}
