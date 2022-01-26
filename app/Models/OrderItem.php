<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Address;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','product_id','price','quantity'];
    
    public function product()
    {
      return $this->belongsTo(Product::class,'product_id','id');
    }
    public function order()
    {
      return $this->belongsTo(Order::class,'order_id','id');
    }
    public function getAddress($id)
    {
      $address = Address::find($id);
      return $address;
    }
    public function getFullName($id)
    {
      $address = Address::find($id);
      $fullName = $address->firstname . " " .  $address->lastname;
      return $fullName;
    }
    public function getFullAddress($id)
    {
      $address = $this->getAddress($id);
      return $address->full_address;
    }
    public function getPostCode($id)
    {
      $address = $this->getAddress($id);
      return $address->postcode;
    }
}
