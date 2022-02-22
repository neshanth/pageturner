<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view("category.index", ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("category.create");
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
            'name' => 'required'
        ]);
        $data = [
            "name"  => $request->name
        ];
        Category::create($data);
        return redirect()->action([CategoryController::class, 'index'])->with("success", "Category Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view("category.edit", ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required",
            'image' => 'max:1000|mimes:png,jpeg,jpg,svg'

        ]);
        $fileName = null;
        if ($request->hasFile('image') && !$this->checkIfImageExists($id, $request)) {
            $fileName = $request->file('image')->getClientOriginalName();
            $existingImage = $this->getImage($id);
            $this->deleteImage($existingImage);
            $request->file("image")->storeAs('public/category', $fileName);
        } else {
            $fileName = $request->file('image')->getClientOriginalName();
        }
        $data = [
            'name' => $request->name,
            'image' => $fileName
        ];
        Category::find($id)->update($data);
        return redirect()->back()->with("success", "Category Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private function checkIfImageExists($id, Request $request): bool
    {
        $category = Category::find($id);
        return $category->image == $request->file('image')->getClientOriginalName();
    }
    private function getImage($id)
    {
        $category = Category::find($id);
        return $category->image;
    }
    private function deleteImage($imageName)
    {
        Storage::delete("/public/category/" . $imageName);
    }
}
