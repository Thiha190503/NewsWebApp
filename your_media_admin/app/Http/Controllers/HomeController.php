<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // direct home page
    public function home() {
        $posts = Post::get();
        return view('admin.home.home',compact('posts'));
    }

    // direct home details page
    public function newsDetails($id) {
        $category = Category::select('categories.title as category_title','posts.*')
        ->join('posts','categories.category_id','posts.category_id')
        ->get();
        $post = Post::where('post_id',$id)->first();
        return view('admin.home.newsDetails',compact('category','post'));
    }
}
