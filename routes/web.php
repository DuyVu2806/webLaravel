<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\AjaxLoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;


Auth::routes();

// Route::get('/', [AdminController::class, 'index'])->name('admin');

/* --ADMIN-- */
Route::group(['prefix'=>'admin', 'middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('logout');

    Route::resources([
        'product' => '\App\Http\Controllers\ProductController',
    ]);

    Route::prefix('products')->name('products.')->group(function(){
        Route::get('/',[ProductController::class,'index'])->name('list');
        Route::get('/add',[ProductController::class,'add'])->name('add');
        Route::post('/add',[ProductController::class,'create'])->name('create');
        Route::get('/edit{id}',[ProductController::class,'edit'])->name('edit');
        Route::post('/edit{id}',[ProductController::class,'update'])->name('update');
        Route::get('/delete{id}',[ProductController::class,'destroy'])->name('delete');
    });

    Route::prefix('category')->name('category.')->group(function(){
        Route::get('/',[CategoryController::class,'index'])->name('list');
        Route::get('/add',[CategoryController::class,'add'])->name('add');
        Route::post('/add',[CategoryController::class,'create'])->name('create');
        Route::get('/edit-{id}',[CategoryController::class,'edit'])->name('edit');
        Route::post('/edit-{id}',[CategoryController::class,'update'])->name('update');
        Route::get('/delete-{id}',[CategoryController::class,'destroy'])->name('delete');
    });

    Route::prefix('customer')->name('customer.')->group(function(){
        Route::get('/',[CustomerController::class,'index'])->name('list');
    });

    Route::prefix('comment')->name('comment.')->group(function(){
        Route::get('/',[CommentController::class,'index'])->name('list');
    });

    Route::prefix('bill')->name('bill.')->group(function(){
        Route::get('/',[ProductController::class,'list'])->name('list');
        Route::post('/edit-{id}',[ProductController::class,'billedit'])->name('billedit');
        Route::get('/detail-{id}',[ProductController::class,'billDetail'])->name('billDetail');
        Route::get('/deleted-{id}',[ProductController::class,'billDeleted'])->name('billDeleted');
    });

});

/*--Customer--*/
Route::get('/home',[HomePageController::class,'home'])->name('home');
Route::get('/products',[HomePageController::class,'products'])->name('products');
Route::get('/contact',[HomePageController::class,'contact'])->name('contact');

Route::get('product-list',[HomePageController::class,'productListAjax'])->name('productListAjax');
Route::post('search-product',[HomePageController::class,'searchProduct'])->name('searchProduct');


Route::get('/products/productDetails-{id}',[HomePageController::class,'productDetails'])->name('productDetails');

Route::get('about',[HomePageController::class,'about'])->name('about');

Route::get('/customer/login', [CustomerController::class, 'login'])->name('customer.login');
Route::post('/customer/login', [CustomerController::class, 'post_login'])->name('customer.login');

Route::get('/customer/register', [CustomerController::class, 'register'])->name('customer.register');
Route::post('/customer/register', [CustomerController::class, 'post_register'])->name('customer.register');

Route::post('add-to-cart',[CartController::class,'addProduct'])->name('add');
Route::post('detele-cart-item',[CartController::class,'deleteProduct'])->name('detele');
Route::post('update-cart',[CartController::class,'updateCart'])->name('updateCart');

Route::group(['prefix'=>'customer', 'middleware' => 'cus'], function(){

    Route::get('/logout', [CustomerController::class, 'logout'])->name('customer.logout');

    Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');

    Route::post('/profile', [CustomerController::class, 'post_profile']);

    Route::get('/order', [CustomerController::class, 'order'])->name('customer.order');

    Route::get('/change_password', [CustomerController::class, 'change_password'])->name('customer.change_password');

    // Cart

    Route::get('cart',[CartController::class,'viewCart'])->name('viewCart');

    Route::get('checkout',[CheckoutController::class,'index'])->name('list');

    Route::post('place-order',[CheckoutController::class,'placeOrder'])->name('placeOrder');

    Route::get('my_order',[CustomerController::class,'myOrder'])->name('myOrder');

    Route::get('delete-my_order-{id}',[CustomerController::class,'delete'])->name('remove');

    Route::get('view_order-{id}',[CustomerController::class,'viewOrder'])->name('viewOrder');

    

});

// Comment

Route::group(['prefix' => 'ajax'],function(){

    Route::post('/login', [AjaxLoginController::class, 'login'])->name('ajax.login');

    Route::post('/comment/{productdetail_id}', [AjaxLoginController::class, 'comment'])->name('ajax.comment');

    Route::get('/logout', [AjaxLoginController::class, 'logout'])->name('ajax.logout');
    
});

