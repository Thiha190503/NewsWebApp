<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function getAllCategories() {
        $categories = Category::get();

        return response()->json([
            'status' => 200,
            'categories' => $categories
        ]);
    }

    //
    public function searchCategories(Request $request) {
        $category = Category::select('posts.*')
                    ->join('posts','categories.category_id','posts.category_id')
                    ->where('categories.title','LIKE','%'.$request->key.'%')
                    ->get();
        return response()->json([
            'result' => $category
        ]);
    }
}
