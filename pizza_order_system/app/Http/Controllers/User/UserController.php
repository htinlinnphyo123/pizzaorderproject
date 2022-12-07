<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct user page
    public function homePage(){
        $categories = Category::get();
        $products = Product::get();
        return view('user.main.home',compact(['products','categories']));
    }

    //direct change password page
    public function changePasswordPage(){
        return view('user.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $this->validateChangePassword($request);
        // dd($request->toarray());

        $id = Auth::user()->id;
        // dd($id);
        $dbPassword = User::select('password')->where('id',$id)->first()->password;

        if(Hash::check($request->oldPassword, $dbPassword)){
            User::where('id',$id)->update([
                'password'=>Hash::make($request->newPassword)
            ]);
            return redirect()->route('user#home')->with(['pwchangeSuccess'=>'Changed Password Successfully']);
        }else{
            return back()->with(['notMatch'=>'Old password is wrong']);
        }
    }

    //update profile
    public function accountDetail(){
        return view('user.account.details');
    }




    //validation for changePassword
    private function validateChangePassword($request){

        $validationRules = [
            'oldPassword' => 'required|min:5',
            'newPassword' => 'required|min:5',
            'confirmPassword' => 'required|same:newPassword'
        ];

        Validator::make($request->all(),$validationRules)->validate();
    }

}
