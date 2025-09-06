<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    # Index Method
    public function GetAllCategory()
    {
        return view('category.index');
    }

    # Index Method
    public function index()
    {
        // return  Category::all();
        // return Category::paginate(5);
        // $category =  Category::latest()->paginate(10);
        $category =  Category::latest()->get();
        return response()->json($category);
    }

    # Store Method
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return $category;
    }

    public function singleCategory($id) {
         return view('category/single-category',[
           'category' =>Category::find($id)]);
    }

    # Show Method
    public function show($id) {
        $category = Category::find($id);
        return response()->json($category);

        // $cat = Category::findOrFail($id); // Single category fetch
        // return view('category.show', compact('cat')); // Pass to show view
    }

    # Edit Method
    public function edit($id) {}

    # Update Method
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return response()->json($category);
    }

    # Delete Method
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return $category;
    }
}
