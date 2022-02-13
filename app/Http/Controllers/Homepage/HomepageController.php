<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
  public function index()
  {
    $products   = DB::table("products")->latest()->limit(10)->get();
    return view("welcome", ['products' => $products]);
  }
}
