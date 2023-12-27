<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // direct post page
    public function index() {
        $categories = Category::get();
        $posts = Post::paginate(5);
        return view('admin.post.index',compact('categories','posts'));
    }

    // CREATE

    // create post
    public function postCreate(Request $request) {
        $validator = $this->postValidationCheck($request);

        if($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if (!empty($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);
            $data = $this->getPostData($request,$fileName);
        } else {
            $data = $this->getPostData($request,NULL);
        }
        Post::create($data);
        return back()->with(['createSuccess' => 'Create Success']);
    }

    // post validation check
    private function postValidationCheck($request){
        $validationRule = [
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postNews' => 'required',
            'postCategory' => 'required',
        ];
        return Validator::make($request->all(),$validationRule);
    }

    // get post data
    private function getPostData($request,$fileName){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'news' => $request->postNews,
            'category_id' => $request->postCategory,
            'image' => $fileName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // EDIT

    // direct edit page
    public function postEditPage($id) {
        $postDetails = Post::where('post_id',$id)->first();
        $categories = Category::get();
        $posts = Post::get();
        $detailPost = Post::where('post_id',$id)->first();
        return view('admin.post.edit',compact('postDetails','categories','posts','detailPost'));
    }

    // UPDATE

    // post update
    public function postUpdate($id,Request $request) {
        $validator = $this->updatePostValidationCheck($request);

        if($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        $data = $this->getUpdatePostData($request);

        if(isset($request->postImage)) {
            $this->storeNewUpdateImage($id,$request,$data);
        } else {
            Post::where('post_id',$id)->update($data);
        }

        return back()->with(['updateSuccess' => 'Update Success']);
    }

    // update post validation check
    private function updatePostValidationCheck($request){
        $validationRule = [
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategory' => 'required',
            'postNews' => 'required',
            'updated_at' => Carbon::now()
        ];
        return Validator::make($request->all(),$validationRule);
    }

    // get update post data
    private function getUpdatePostData($request) {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'news' => $request->postNews,
            'category_id' => $request->postCategory,
        ];
    }

    // store new update image
    private function storeNewUpdateImage($id,$request,$data) {
        $file = $request->file('postImage');
        $fileName = uniqid().'_'.$file->getClientORiginalName();
        $data['image'] = $fileName;

        $dbFile = Post::where('post_id',$id)->first();
        $dbFileImage = $dbFile['image'];

        if (File::exists(public_path().'/postImage/'.$dbFileImage)) {
            File::delete(public_path().'/postImage/'.$dbFileImage);
        };

        $file->move(public_path().'/postImage/',$fileName);

        Post::where('post_id',$id)->update($data,$fileName);
    }

    // DELETE
    public function postDelete($id) {
        Post::where('post_id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Delete Success']);
    }

    // SEARCH

    // post search
    public function postSearch(Request $request) {
        $categories = Category::get();
        $posts = Post::where('title','LIKE','%'.$request->postSearch.'%')->get();
        return view('admin.post.index',compact('categories','posts'));
    }


}
