<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct category page
    public function index() {
        $categories = Category::paginate(5);
        return view('admin.category.index',compact('categories'));
    }

    // CREATE

    // categroy Create
    public function categoryCreate(Request $request) {
        $validator = $this->categoryValidationCheck($request);

        if($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $data = $this->getCategoryData($request);
        Category::create($data);
        return back()->with(['createSuccess'=>'Create Success']);
    }

    // category Validation Check
    private function categoryValidationCheck($request) {
        $validationRule = [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ];
        return Validator::make($request->all(),$validationRule);
    }

    // get Category Data
    private function getCategoryData($request) {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // EDIT PAGE

    // direct Edit Page
    public function categoryEditPage($id) {
        $categories = Category::get();
        $oldData = Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('oldData','categories'));
    }

    // UPDATE

    // category Update
    public function categoryUpdate($id,Request $request) {
        $validator = $this->updateCategoryValidationCheck($request);

        if($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $data = $this->getCategoryUpdate($request);
        Category::where('category_id',$id)->update($data);
        return redirect()->route('admin#category')->with(['updateSuccess'=>'Update Success']);
    }

    // update Category Validation Check
    private function updateCategoryValidationCheck($request) {
        $validationRule = [
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ];

        return Validator::make($request->all(),$validationRule);
    }

    // get Category Update
    private function getCategoryUpdate($request) {
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // DELETE

    // category Delete
    public function categoryDelete($id) {
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Success']);
    }

    // SEARCH

    // category Search
    public function categorySearch(Request $request) {
        $categories = Category::where('title','LIKE','%'.$request->categorySearch.'%')->get();
        return view('admin.category.index',compact('categories'));
    }
}
