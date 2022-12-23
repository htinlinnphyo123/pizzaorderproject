<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//pizza list
Route::get('product/list',[APIController::class,'pizzaList']);

//category list
Route::get('category/list',[APIController::class,'categoryList']);

//admin list
Route::get('admin/list',[APIController::class,'adminList']);

//user list
Route::get('user/list',[APIController::class,'userList']);

//cart list
Route::get('cart/all/list',[APIController::class,'totalCartList']);
//each user cart list
Route::get('cart/user/{id}/list',[APIController::class,'eachUserCartList']);

//order List
Route::get('order/all/list',[APIController::class,'totalOrderList']);
Route::get('order/user/{id}/list',[APIController::class,'eachUserOrderList']);

//orderitem List
Route::get('orderitem/all/list',[APIController::class,'totalOrderItemList']);
Route::get('orderitem/user/{id}/list',[APIController::class,'eachUserOrderItemList']);


//rating list
Route::get('rating/all/list',[APIController::class,'totalRatingList']);
Route::get('rating/product/{id}/list',[APIController::class,'ratingByEachProduct']);





//create category
Route::post('category/create',[APIController::class,'createCategory']);

//create product
Route::post('product/create',[APIController::class,'createProduct']);

//create rating
Route::post('rating/create',[APIController::class,'createRating']);

//create cart
Route::post('cart/create',[APIController::class,'createCart']);

//create order
Route::post('order/create',[APIController::class,'createOrder']);

//create contact
Route::post('contact/create',[APIController::class,'createContact']);






/*
127.0.0.1:8000/api/product/list
127.0.0.1:8000/api/category/list
127.0.0.1:8000/api/admin/list
127.0.0.1:8000/api/user/list
127.0.0.1:8000/api/cart/all/list
127.0.0.1:8000/api/cart/user/{user_id}/list
127.0.0.1:8000/api/order/all/list
127.0.0.1:8000/api/order/user/{user_id}/list
127.0.0.1:8000/api/rating/all/list
127.0.0.1:8000/api/rating/product/{product_id}/list


127.0.0.1:8000/api/category/create
127.0.0.1:8000/api/product/create
127.0.0.1:8000/api/rating/create
127.0.0.1:8000/api/cart/create



*/
