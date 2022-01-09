<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomepageController extends Controller
{
    public function index()
    {
      $categories = Category::all();
      $products   = Product::all();
      return view("welcome", ['categories' => $categories,'products' => $products]);
    }
}
