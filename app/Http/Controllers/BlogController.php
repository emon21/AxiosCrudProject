<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //GetAllBlog
    function GetAllBlog()
    {
        return view("blog.index");
    }


    // store

    public function store(Request $request){
       
        // $this->validate($request, [
        //     "title"=> "required",
        //     "description"=> "required",
        //     "image"=> "required",
        //     ]);

            // $data = $request->all();

            // return response()->json($data);

        return Blog::create($request->all());

    }


}
