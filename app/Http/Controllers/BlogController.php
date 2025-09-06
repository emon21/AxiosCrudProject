<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BlogController extends Controller
{
    //GetAllBlog
    function GetAllBlog()
    {
        return view("blog.index");
    }

    function index()
    {
        // return view("blog.index");
        // $api = Http::get("https://jsonplaceholder.typicode.com/users");
        // return response()->json(["blog" => $api->json()]); //$api;

        return Blog::latest()->get();
        // return response()->json(Blog::all());
    }

    // store

    public function store(Request $request)
    {
        // return response()->json($data);

        // return $request->all();
        return Blog::create($request->all());
    }

    # show
    public function show($id)
    {
        $blog = Blog::find($id);
        return $blog;

        // return view("blog.index", compact(""));
    }

    # update
    public function update(Request $request, Blog $blog) {}

    # Delete Method
    public function destroy(Blog $blog)
    {

        return response()->json([
            "message" => "Blog Deleted",
            "data" => $blog->delete()
        ], 200);
    }
}
