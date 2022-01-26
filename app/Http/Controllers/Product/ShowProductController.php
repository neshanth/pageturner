<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShowProductController extends Controller
{
    public function index($id)
    {
      $product = Product::find($id);
      return view("product.show",['product' => $product]);
    }
}
