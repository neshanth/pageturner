<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShowCategoryController extends Controller
{
    public function index($id)
    {
       $products = Product::where("cat_id",'=',$id)->get();
       $categoryName = Category::find($id)->name;
       return view("category.show",['products' => $products,'title' => $categoryName]);

    }
}
