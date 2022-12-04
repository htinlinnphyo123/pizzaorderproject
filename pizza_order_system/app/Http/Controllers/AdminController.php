<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
        //password change page
        public function changePasswordPage(){
            return view('admin.account.changePassword');
        }

        //change password route
        public function changepassword(Request $request){
            // dd($request->toarray());

            /*
                1.all field must be filled
                2.new password and confirm password length > 6
                3.newpassword and confirm must same
                4.old password must be the same to the db pw
                5.password change
            */

            $this->passwordValidationCheck($request);
            $currentDataId = Auth::user()->id;
            // dd($currentDataId);
            $user = User::select('password')->where('id',$currentDataId)->first();
            $dbPassword = $user->password;
            // dd($dbPassword);



            if(Hash::check($request->oldPassword, $dbPassword)){
                User::where('id',$currentDataId)->update([
                    'password'=>Hash::make($request->newPassword)
                ]);
                // Auth::logout();
                return redirect()->route('category#list')->with(['pwchange'=>'Password Changed Successfully']);
            }else{
                return back()->with(['notMatch'=>'Old password is wrong']);
            }


        }

        //admin direct details
        public function details(){
            return view('admin.account.details');
        }

        //edit direct page
        public function edit(){
            return view('admin.account.edit');
        }

        //update profile
        public function update($id,Request $request){
            // dd($id,$request->all());
            $this->accountValidationCheck($request);
            // dd($request->all());
            $data = $this->getUserData($request);

            //for image
            if($request->hasFile('image')){
                $dbImage = User::where('id',$id)->first();
                $dbImage = $dbImage->image;
                // dd($dbImage);

                if($dbImage!='null'){
                    Storage::delete('public/'.$dbImage);
                }

                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                // dd($fileName);
                $request->file('image')->storeAs('public',$fileName);
                $data['image'] = $fileName;
            }


            User::where('id',$id)->update($data);
            return redirect()->route('admin#details')->with(['updateSuccess'=>'User Account Updated']);
        }

        // direct admin list page
        public function adminListPage(){
            return view('admin.account.list');
        }

        //get user data
        private function getUserData($request){
            return [
                'name' => $request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'gender' => $request->gender,
                'updated_at'=>Carbon::now()
            ];
        }

        //validation for user accout
        private function accountValidationCheck($request){
            Validator::make($request->all(),[
                'name'=> 'required|string|max:255',
                'email'=>'required|string|max:255',
                'phone'=>'required',
                'image'=>'mimes:jpg,png,jpeg|file',
                'address'=>'required',
                'gender'=>'required'
            ])->validate();
        }

        //validation for password
        private function passwordValidationCheck($request){
            Validator::make($request->all(),[
                'oldPassword' => 'required|min:6',
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required|min:6|same:newPassword'
            ])->validate();
        }


}
