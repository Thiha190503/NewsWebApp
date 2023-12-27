<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // direct admin home page
    public function index() {
        $id = Auth::user()->id;
        $loginUser = User::select('id','name','email','phone','address','gender')->where('id',$id)->first();
        return view('admin.profile.index',compact('loginUser'));
    }

    public function updateAdminAccount(Request $request) {
        $userData = $this->getUserInfo($request);
        $validator = $this->userValidationCheck($request);

        if($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>'Admin account updated!']);
    }

    // get user info
    private function getUserInfo($request) {
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'address' => $request->adminAddress,
            'phone' => $request->adminPhone,
            'gender' => $request->adminGender,
            'updated_at' => $request->updated_at,
        ];
    }

    // user validation check
    private function userValidationCheck($request) {
        return Validator::make($request->all(),[
            'adminName' => 'required',
            'adminEmail' => 'required',
        ],[
            'adminName.required' => 'Name is required',
            'adminEmail.required' => 'Email is required',
        ]);
    }

    // CHANGE PASSWORD PAGE

    // change password page
    public function changePasswordPage() {
        return view('admin.profile.changePasswordPage');
    }

    // change password
    public function changePassword(Request $request) {
        $validator = $this->changePasswordValidationCheck($request);

        if($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $dbData = User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbData->password;

        $HashPassword = Hash::make($request->newPassword);
        $newDbPassword = [
            'password' => $HashPassword,
            'updated_at' => Carbon::now(),
        ];

        if(Hash::check($request->oldPassword,$dbPassword)) {
            User::where('id',Auth::user()->id)->update($newDbPassword);
            return redirect()->route('dashboard');
        } else {
            return back()->with(['fail' => 'Old Password Do Not Match!']);
        }

    }

    // changePasswordValidationCheck
    private function changePasswordValidationCheck($request) {
        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:7|max:20',
            'confirmPassword' => 'required|same:newPassword|min:7|max:20',
        ];
        $validationMessage = [
            'confirmPassword.same' => 'New Password AND Old Password must be same'
        ];
        return Validator::make($request->all(),$validationRules,$validationMessage);
    }
}
