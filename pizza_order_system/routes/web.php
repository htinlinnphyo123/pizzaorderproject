<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;


//login register

Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','loginPage');
    Route::get('/loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('/registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin
    Route::middleware(['admin_auth'])->group(function(){

        //category
        Route::prefix('category')->group(function(){
                Route::get('list',[CategoryController::class,'listPage'])->name('category#list');
                Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
                Route::post('create',[CategoryController::class,'create'])->name('category#create');
                Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
                Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
                Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });

        //admin account
        Route::prefix('admin')->group(function(){
            //password
            Route::get('password/changepage',[AdminController::class,'changePasswordPage'])->name('admin#changepasswordPage');
            Route::post('password/change',[AdminController::class,'changepassword'])->name('admin#changepassword');

            //account
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
            Route::get('list',[AdminController::class,'adminListPage'])->name('admin#list');
            Route::get('role/change/{id}',[AdminController::class,'adminRoleChangePage'])->name('admin#roleChangePage');
            Route::post('role/change',[AdminController::class,'adminRoleChange'])->name('admin#change');
            Route::get('delete/{id}',[AdminController::class,'adminDelete'])->name('admin#delete');
        });

        //pizza
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'listPage'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('details/{id}',[ProductController::class,'detail'])->name('product#detail');
            Route::get('edit/{id}',[ProductController::class,'editPage'])->name('product#editPage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });

        //order
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('filter',[OrderController::class,'filterStatus'])->name('admin#filterOrderStatus');
            Route::get('statusChange',[OrderController::class,'statusChange'])->name('admin#statusChange');
            Route::get('detail/{odcode}',[OrderController::class,'orderDetails'])->name('admin#orderDetails');
        });

        //user list
        Route::prefix('user')->group(function(){
            Route::get('list',[AdminController::class,'userListPage'])->name('admin#userListPage');
            Route::get('/statusChange',[AdminController::class,'useraccStatusChange'])->name('admin#userstatusChange');
            Route::get('delete/{id}',[AdminController::class,'userAccountdelete'])->name('admin#userAccountDelete');
        });

        //contact
        Route::prefix('contact')->group(function(){
            Route::get('view',[AdminController::class,'viewContact'])->name('admin#contactPage');
        });


    });


    //user
    //home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        // Route::get('homepage',function(){
        //     return view('user.home');
        // })->name('user#home');

        Route::get('/homePage',[UserController::class,'homePage'])->name('user#home');

        //password
        Route::prefix('password')->group(function(){
            Route::get('changePasswordPage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('changePassword',[UserController::class,'changePassword'])->name('user#changePassword');
        });

        //update profile
        Route::prefix('profile')->group(function(){
            Route::get('detail',[UserController::class,'accountDetail'])->name('user#accountDetails');
            Route::get('updatePage',[UserController::class,'updatePage'])->name('user#updatePage');
            Route::post('update',[UserController::class,'update'])->name('user#update');
        });

        //ajax
        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'getPizzaAjaxData'])->name('ajax#pizzaList');
            Route::get('cart',[AjaxController::class,'getcartadd'])->name('ajax#cartadd');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('cartDelete',[AjaxController::class,'cartDelete'])->name('ajax#cartDelete');
            Route::get('eachCartDelete',[AjaxController::class,'eachCartDelete'])->name('ajax#eachCartDelete');
        });
        //viewCount
        Route::get('pizza/details/increase/viewCount',[AjaxController::class,'viewCount'])->name('ajax#viewCount');

        //filter
        Route::get('pizza/filter/{id}',[UserController::class,'pizzaFilter'])->name('user#pizzaFilter');

        //detail
        Route::get('pizza/details/{id}',[UserController::class,'pizzaDetail'])->name('user#pizzaDetails');

        //cart
        Route::prefix('cart')->group(function(){
            Route::get('list/{id}',[CartController::class,'cartListPage'])->name('user#cartListPage');
        });

        //history
        Route::get('history/{id}',[UserController::class,'historyPage'])->name('user#history');

        //rating
        Route::post('rating',[RatingController::class,'rating'])->name('user#rating');

        //contact
        Route::prefix('contact')->group(function(){
            Route::get('view',[ContactController::class,'contactPage'])->name('user#contact');
            Route::post('sendContact',[ContactController::class,'sendMessage'])->name('user#sendContact');

        });

    });


});

