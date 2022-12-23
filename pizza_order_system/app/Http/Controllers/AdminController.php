<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Contact;
use App\Models\OrderList;
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
            $admins = User::when(request('key'),function($query){
                                $query->orWhere('name','LIKE','%'.request('key').'%')
                                    ->orWhere('email','LIKE','%'.request('key').'%')
                                    ->orWhere('gender','LIKE','%'.request('key').'%')
                                    ->orWhere('phone','LIKE','%'.request('key').'%')
                                    ->orWhere('address','LIKE','%'.request('key').'%');
                                })
                            ->where('role','admin')
                            ->paginate(3);
            // dd($admins);
            $admins->appends(request()->all());
            return view('admin.account.list',compact(['admins']));
        }

        //role change direct page
        public function adminRoleChangePage($id){
            $users = User::where('id',$id)->first();
            return view('admin.account.changeRole',compact(['users']));
        }

        //role change function
        public function adminRoleChange(Request $request){
            // dd($request->toarray());
            $id = $request->userId;
            $data = ['role'=>$request->userRole];
            User::where('id',$id)->update($data);
            return redirect()->route('admin#list');
        }

        // account delete
        public function adminDelete($id){
            User::where('id',$id)->delete();
            return back();
        }

        //user list page
        public function userListPage(){
            $users = User::when(request('key'),function($query){
                        $query->where('name','LIKE','%'.request('key').'%')
                                ->orWhere('email','LIKE','%'.request('key').'%')
                                ->orWhere('phone','LIKE','%'.request('key').'%');
                        })
                    ->where('role','user')->paginate(4);
            return view('admin.useraccount.list',compact(['users']));
        }

        //user account status change
        public function useraccStatusChange(Request $request){
            // logger($request->all());

            User::where('id',$request->userId)->update([
                'role' => $request->status
            ]);

            return response()->json([
                'status' => 'successful',
                'message' => 'successfully updated user to admin'
            ],200);

        }

        //user account delete
        public function userAccountdelete($id){
            User::where('id',$id)->delete();
            Rating::where('user_id',$id)->delete();
            Order::where('user_id',$id)->delete();
            Cart::where('user_id',$id)->delete();
            OrderList::where('user_id',$id)->delete();
            return redirect()->route('admin#userListPage');
        }

        //contact view direct page
        public function viewContact(){
            $contacts = Contact::orderBy('created_at','desc')->paginate(4);
            // dd($contacts->toarray());
            return view('admin.contact.list',compact(['contacts']));
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
