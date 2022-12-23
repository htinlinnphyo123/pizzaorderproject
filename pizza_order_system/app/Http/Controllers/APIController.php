<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{

    // START LIST FOLDER

    //get pizza list
    public function pizzaList(){
        $pizza = Product::get();
        return response()->json($pizza,200);
    }

    //get category list
    public function categoryList(){
        $category = Category::get();
        return response()->json($category,200);
    }

    //get admin list
    public function adminList(){
        $admin = User::where('role','admin')->get();
        return response()->json($admin,200);
    }

    //user list
    public function userList(){
        $user = User::where('role','user')->get();
        return response()->json($user,200);
    }

    //cart list
    //all user
    public function totalCartList(){
        $cart = Cart::get();
        return response()->json($cart,200);
    }
    //each user
    public function eachUserCartList($id){
        $cart = Cart::where('user_id',$id)->get();
        return response()->json($cart,200);
    }

    //order List
    //all user
    public function totalOrderList(){
        $order = Order::get();
        return response()->json($order,200);
    }
    //each user
    public function eachUserOrderList($id){
        $order = Order::where('user_id',$id)->get();
        return response()->json($order,200);
    }

    //orderitem List
    //all user
    public function totalOrderItemList(){
        $order = OrderList::get();
        return response()->json($order,200);
    }
    //each user
    public function eachUserOrderItemList($id){
        $order = OrderList::where('user_id',$id)->get();
        return response()->json($order,200);
    }


    //all rating list
    public function totalRatingList(){
        $rating = Rating::get();
        return response()->json($rating,200);
    }
    //rating list by each product
    public function ratingByEachProduct($id){
        $rating = Rating::where('product_id',$id)->get();
        return response()->json($rating,200);
    }

    // END LIST FOLDER



    //START CREATE FOLDER

    //create category
    public function createCategory(Request $request){
        $data = $this->getCategoryData($request);
        Category::create($data);
        return response()->json([
            'status' => 'successful',
            'message' => 'Category Created Successfully.',
            'data' => $data
        ],200);
    }

    //create product
    public function createProduct(Request $request){
        // dd($request->all());
        $data = $this->getProductData($request);

        if($request->hasFile('pizza_image')){
            $fileName = uniqid().$request->file('pizza_image')->getClientOriginalName();
            $request->file('pizza_image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Product::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Product Created Successfully'
        ],200);
    }

    //create Rating
    public function createRating(Request $request){

        $data = $this->getRatingData($request);

        Rating::create($data);
        return response()->json([
            'status' => 'success',
            'messge' => 'Rating Created Successfully'
        ],200);
    }

    //creat cart
    public function createCart(Request $request){

        $data = $this->getCartData($request);
        Cart::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Created Cart Successfully',
            'data' => $data
        ],200);
    }

    //create order
    public function createOrder(Request $request){

        $billtotal = 0;
        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id' =>$item['user_id'],
                'product_id'=>$item['product_id'],
                'qty'=>$item['qty'],
                'product_total_price'=>$item['product_total_price'],
                'order_code'=>$item['order_code']
            ]);

            $billtotal += $item['product_total_price'];
            $payment = $item['payment'];
        }

        //to remove from cart

        Cart::where('user_id',$data['user_id'])->delete();

        //to add to order
        Order::create([
            'user_id'=>$data['user_id'],
            'order_code'=>$data['order_code'],
            'payment' => $payment,
            'order_total_price' => $billtotal +3000,
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>'ordered successfully'
        ], 200);



    }

    //create contact
    public function createContact(Request $request){
        $data = $this->getContactData($request);
        Contact::create($data);
        return response()->json([
            'status' => 'successful',
            'message' => 'contact sent successfully',
            'data' => $data
        ],200);
    }



















    //get contact data
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];
    }

    //get cart data
    private function getCartData($request){
        return [
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'qty' =>  $request->qty,
        ];
    }

    // get rating data
    private function getRatingData($request){
        return [
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'rating_count' => $request->rating_count,
            'message' => $request->review
        ];
    }

    //get category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name
        ];
    }

    //get product data
    private function getProductData($request){
        return [
            'name' => $request->product_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price'=> $request->price,
            'waiting_time'=>$request->waiting_time,
            'view_count'=>$request->view_count,
        ];
    }


}
