<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //for order list page
    public function orderList(){
        $orders = Order::select('*','orders.created_at as order_created_at')
                        ->leftJoin('users','orders.user_id','users.id')
                        ->orderBy('orders.created_at','desc')
                        ->get();
                        // dd($orders->toarray());
        return view('admin.order.list',compact(['orders']));
    }

    //update each order list with ajax
    public function statusChange(Request $request){
        // logger($request->all());

        Order::where('order_code',$request->order_code)->update([
            'status' => $request->order_status
        ]);

        return response()->json([
            'message' => 'status changed success'
        ], 200);

    }

    //to filter status with select option box
    public function filterStatus(){
        $status = request('status');

        $orders = Order::select('*','orders.created_at as order_created_at')
                        ->leftJoin('users','orders.user_id','users.id')
                        ->orderBy('orders.created_at','desc');
                        // dd($orders->toarray());

        if($status == 'all'){
            $orders= $orders->get();
        }else if($status == 'pending'){
            $orders = $orders->where('orders.status',0)->get();
        }else if($status == 'rejected'){
            $orders = $orders->where('orders.status',1)->get();
        }else if($status == 'success'){
            $orders = $orders->where('orders.status',2)->get();
        }

        return view('admin.order.list',compact(['orders','status']));
    }

    //order details page redirect
    public function orderDetails($odcode){
        $orders = OrderList::select('*','products.name as product_name','users.name as user_name','order_lists.created_at as ordered_time','products.image as product_image')
                        ->leftJoin('products','order_lists.product_id','products.id')
                        ->leftJoin('users','order_lists.user_id','users.id')
                        ->where('order_lists.order_code',$odcode)->get();
        // dd($orders->toarray());

        $users = User::select('*')
                    // ->leftJoin('order_lists','users.id','order_lists.user_id')
                    ->leftJoin('orders','users.id','orders.user_id')
                    ->where('orders.order_code',$odcode)->first();
                    // dd($users->toarray());

        return view('admin.order.detail',compact(['orders','users']));
    }


}
