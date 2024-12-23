<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $table = 'statistics';
}
