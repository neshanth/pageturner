<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $bookName = $request->input("book");
        $books = DB::table('products')
            ->where("title", "LIKE", "%{$bookName}%")
            ->get();
        return view("search.index", ['products' => $books, 'bookName' => $bookName]);
    }
}
