<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'cart';

    protected $guards =[];
}
