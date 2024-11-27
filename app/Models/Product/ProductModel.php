<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'product';
}
