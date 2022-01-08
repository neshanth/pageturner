<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class HomepageController extends Controller
{
    public function index()
    {
      $categories = Category::all();
      return view("welcome", ['categories' => $categories]);
    }
}
