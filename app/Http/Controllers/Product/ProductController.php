<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

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
        $products = Product::all();
        return view("product.index",['products' => $products]);
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
           'cat_id' => 'required',
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
         'cat_id'=> $request->cat_id,
         'stock' => $request->stock,
         'description' => $request->description,
         'image' => $fileName
        ];
        Product::create($data);
        return redirect()->back()->with('success','Product Created');
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
        $product = Product::where("id",$id)->get();
        $categories = Category::all();
        return view("product.edit",['product' => $product,'categories' => $categories]);
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
         $request->validate([
                   'title' => "required|unique:products,title,$id",
                   'price' => 'required|min:10|numeric',
                   'cat_id' => 'required',
                   'stock' => 'required|numeric',
                   'description' => 'required',
                   'image' => 'max:1000|mimes:png,jpeg,jpg,svg'
         ]);
         $fileName = null;
         if($request->hasFile('image') && !$this->checkIfImageExists($id,$request)){
              $fileName = $request->file('image')->getClientOriginalName();
              $existingImage = $this->getImage($id);
              $this->deleteImage($existingImage);
              $request->file("product")->storeAs('public/product',$fileName);
         }else{
            $fileName = $request->file('image')->getClientOriginalName();
         }
         $data = [
                  'title' => $request->title,
                  'price' => $request->price,
                  'cat_id'=> $request->cat_id,
                  'stock' => $request->stock,
                  'description' => $request->description,
                  'image' => $fileName
         ];
         Product::find($id)->update($data);
         return redirect()->back()->with("success","Product Updated Successfully");
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
    private function checkIfImageExists($id,Request $request): bool
    {
         $product = Product::find($id);
         return $product->image == $request->file('image')->getClientOriginalName();
    }
    private function getImage($id)
    {
       $product = Product::find($id);
       return $product->image;
    }
     private function deleteImage($imageName)
     {
       Storage::delete("/public/product/".$imageName);
     }
}
