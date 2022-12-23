<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //get data for filter data asc desc
    public function getPizzaAjaxData(Request $request){
        // logger($request->status);
        // logger($request->category_id);

        if($request->category_id==null){
            if($request->status == 'asc'){
                $data = Product::orderBy('created_at','asc')->get();
            }else if($request->status == 'desc'){
                $data = Product::orderBy('created_at','desc')->get();
            }
        }else{
            if($request->status == 'asc'){
                $data = Product::where('category_id',$request->category_id)
                            ->orderBy('created_at','asc')->get();
            }else if($request->status == 'desc'){
                $data = Product::where('category_id',$request->category_id)
                            ->orderBy('created_at','desc')->get();
            }
        }
        return $data;
    }

    //get ajax for card add and return
    public function getcartadd(Request $request){
        // logger($request->all());

        $data = $this->ajaxdatarequest($request);
        Cart::create($data);

        $response = [
            'status' => 'success',
            'message' => 'Added to cart successfully'
        ];
        return response()->json($response, 200);

    }

    // order
    public function order(Request $request){
        // logger($request->all());

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
        Cart::where('user_id',Auth::user()->id)->delete();

        //to add to order
        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$data['order_code'],
            'payment' => $payment,
            'order_total_price' => $billtotal +3000,
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>'ordered successfully'
        ], 200);



    }

    //clear all cart
    public function cartDelete(){
        $cart = Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'status' => 'success'
        ], 200);
    }

    //each cart
    public function eachCartDelete(Request $request){
        // logger($request->all());

        $cart = Cart::where('id',$request->cart_id)->delete();
        return response()->json([
            'status' => 'success'
        ], 200);

    }

    //view count ajax request
    public function viewCount(Request $request){
        // logger($request->all());

        $pizzas = Product::where('id',$request->productId)->first();

        Product::where('id',$request->productId)->update([
            'view_count' => $pizzas->view_count +1
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);



    }




    //get data
    private function ajaxdatarequest($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }


}
