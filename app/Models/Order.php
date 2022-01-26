<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','total','address_id'];
}
