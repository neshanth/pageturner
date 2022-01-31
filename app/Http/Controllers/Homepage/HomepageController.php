<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    $products   = DB::table("products")->latest()->limit(10)->get();
    return view("welcome", ['categories' => $categories, 'products' => $products]);
  }
}
