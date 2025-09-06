<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //get-all-product
    public function GetAllProduct(){

        return view("admin.product.index");

    }

    public function index()
    {
        return Product::with('category')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);
        return Product::create($request->all());
    }

    public function show($id)
    {
        return Product::with('category')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return $product;
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
