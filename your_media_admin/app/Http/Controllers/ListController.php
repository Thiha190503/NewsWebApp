<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    // direct admin list page
    public function index() {
        $admins = User::paginate(5);
        return view('admin.list.index',compact('admins'));
    }

    // DELETE

    // account delete
    public function accountDelete($id) {
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Success']);
    }

    //SEARCH

    // account search
    public function accountSearch(Request $request) {
        $admins = User::orWhere('name','LIKE','%'.$request->accountSearch.'%')
        ->orWhere('email','LIKE','%'.$request->accountSearch.'%')
        ->orWhere('phone','LIKE','%'.$request->accountSearch.'%')
        ->orWhere('address','LIKE','%'.$request->accountSearch.'%')
        ->orWhere('gender','LIKE','%'.$request->accountSearch.'%')
        ->get();

        return view('admin.list.index',compact('admins'));
    }
}
