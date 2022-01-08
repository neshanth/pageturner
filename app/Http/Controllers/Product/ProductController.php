<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{

     public function __construct()
     {
       $this->middleware('auth');
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("product.create",['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'price' => 'required|min:10|numeric',
           'category' => 'required',
           'stock' => 'required|numeric',
           'description' => 'required',
           'image' => 'max:1000|mimes:png,jpeg,jpg,svg'
        ]);
        $fileName = null;
        if($request->file('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/product',$fileName);

        }
        $data = [
         'title' => $request->title,
         'price' => $request->price,
         'category'=> $request->category,
         'stock' => $request->stock,
         'description' => $request->description,
         'image' => $fileName
        ];
        Product::create($data);
        return redirect()->back()->with('success','Product Created')
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
