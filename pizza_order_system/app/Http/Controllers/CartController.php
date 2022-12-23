<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartListPage($id){
        $carts = Cart::select('*','products.name as product_name','products.image as product_image','products.price as product_price','carts.qty as quantity','carts.id as cart_id')
                    ->where('carts.user_id',$id)
                    ->join('products','carts.product_id','products.id')
                    ->get();

        // dd($carts->toarray());

        $totalprice = 0;

        foreach($carts as $c){
            $qty = $c->quantity;
            $rate = $c->product_price;

            $totalprice += ($qty * $rate);
        };
        // dd($totalprice);


        return view('user.cart.cartList',compact(['carts','totalprice']));
    }
}
