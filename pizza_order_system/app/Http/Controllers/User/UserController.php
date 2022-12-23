<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct user page
    public function homePage(){
        $categories = Category::get();
        $products = Product::get();
        $productCount = DB::table('products')->select('category_id',DB::raw("count('*') as total_category_id"))
                                ->groupBy('category_id')
                                ->get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();

        $eachRating = Product::select('products.name',DB::raw('AVG(rating_count) as rating'))
                        ->leftJoin('ratings','products.id','ratings.product_id')
                        ->groupBy('products.name')
                        ->get();
        // dd($carts->toarray());
        // dd($productCount);
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact(['products','categories','productCount','carts','orders','eachRating']));
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

    //detail profile
    public function accountDetail(){
        return view('user.account.details');
    }

    //direct update page
    public function updatePage(){
        return view('user.account.update');
    }

    //update page
    public function update(Request $request){
        $this->validateUpdateProfile($request);

        $data = $this->getUserData($request);
        // dd($data);
        $id = $request->id;

        if($request->hasFile('image')){
            $dbImage = Auth::user()->image;

            if($dbImage!==null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->image->getClientOriginalName();

            $request->image->storeAs('public',$fileName);

            $data['image'] = $fileName;

        }

        User::where('id',$id)->update($data);

        return redirect()->route('user#accountDetails')->with(['updateSuccess'=>'Updated Successfully']);

    }

    //filter by category
    public function pizzaFilter($id){
        $categories = Category::get();
        $products = Product::where('category_id',$id)
                        ->get();

        $category_id = Category::where('id',$id)->first();

        $carts = Cart::where('user_id',Auth::user()->id)->get();

        $productCount = DB::table('products')->select('category_id',DB::raw("count('*') as total_category_id"))
                            ->groupBy('category_id')
                            ->get();
        // dd($category_id);
        return view('user.main.filter',compact(['products','categories','category_id','productCount','carts']));
    }

    // direct pizza Detail Page
    public function pizzaDetail($id){
        $selectProduct = Product::where('id',$id)->first();
        // dd($selectProduct);

        $restProduct = Product::where('id','<>',$id)
                            ->limit(8)
                            ->orderBy('view_count','desc')
                            ->get();
        // dd($restProduct->toarray());

        $reviews =  Rating::select('*','users.name as user_name','products.name as product_name','users.image as user_image','ratings.updated_at as rating_time')
                        ->leftJoin('users','ratings.user_id','users.id')
                        ->leftJoin('products','ratings.product_id','products.id')
                        ->orderBy('ratings.created_at','desc')
                        ->where('ratings.product_id',$id)
                        ->limit(5)
                        ->get();

        $Rating = Rating::select(DB::raw('AVG(rating_count) as avg_rating'),DB::raw('COUNT(id) as count_rater'))
                            ->where('product_id',$id)->get()->first();
        // dd($Rating->toarray());
        $avgRating = round($Rating->avg_rating,1);
        $avgRatingTwo = round($Rating->avg_rating,1);
        // dd($avgRating);

        $eachRating = Rating::select(DB::raw('AVG(rating_count) as rating_avg'),DB::raw('COUNT(rating_count) as count_rater'))
                        ->where('product_id',$id)
                        ->groupBy('rating_count')->get();

        return view('user.order.details',compact(['selectProduct','restProduct','reviews','Rating','avgRating','avgRatingTwo','eachRating']));
    }

    //direct history page
    public function historyPage($id){
        $forwaitingtime = OrderList::select(DB::raw('MAX(products.waiting_time) as max_waiting_time'),DB::raw('order_lists.order_code as wtordercode'))
                        ->leftJoin('products','order_lists.product_id','products.id')
                        ->where('user_id',Auth::user()->id)
                        ->groupBy('order_lists.order_code')
                        ->get();

                    // dd($forwaitingtime->first()->toarray());
        $orders = Order::where('user_id',Auth::user()->id)
                        ->orderBy('created_at','desc')
                        ->paginate(4);

            // dd($forwaitingtime->toarray());
        return view('user.main.history',compact(['forwaitingtime','orders']));
    }






    //get user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender
        ];
    }


    //validation for update profile
    private function validateUpdateProfile($request){
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.$request->id,
            'phone'=> 'required',
            'address'=>'required',
            'gender'=>'required'
        ];
        Validator::make($request->all(),$validationRules)->validate();
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
