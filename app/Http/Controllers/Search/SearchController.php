<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input("query");
        $books = DB::table('products')
            ->where("title", "LIKE", "%{$query}%")
            ->orWhere("author", "LIKE", "%{$query}%")
            ->get();
        return view("search.index", ['products' => $books, 'query' => $query]);
    }
}
