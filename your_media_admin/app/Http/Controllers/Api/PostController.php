<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    public function index() {
        $posts = Post::get();
        if($posts->count() > 0) {
            return response()->json([
                'status' => 200,
                'posts' => $posts,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Posts Found',
            ]);
        }
    }

    public function searchPosts(Request $request) {
        $posts = Post::where('title','LIKE','%'.$request->key.'%')->get();
        return response()->json([
            'searchData' => $posts
        ]);
    }

    public function getNewsDetails($id) {
        $newsDetails = Post::where('post_id',$id)->get();
        if ($newsDetails) {
            return response()->json([
                'status' => 200,
                'newsDetails' => $newsDetails
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No News Details Found!'
            ]);
        }
    }
}
