<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use PhpParser\Node\Name;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/input-email',[PageController::class,'getinputEmail'])->name('getinputEmail');
Route::post('/input-email',[PageController::class,'postinputEmail'])->name('postinputEmail');
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[PageController::class,'index']
)->name('/');
Route::get('product/{id}',[PageController::class,'product']
)->Name('product');

Route::get('shopping_cart',[PageController::class,'shopping_cart']
)->name('shopping_cart');
Route::get('login',[PageController::class,'login']
);
Route::get('products',[PageController::class,'products']
)->name('products');
Route::get('add-to-cart/{id}',[PageController::class,'addToCart'])->name('banhang.addToCart');
Route::get('del-cart/{id}',[PageController::class,'delCartItem'])->name('banhang.xoagiohang');
Route::get('SaveListItemCart/{id}/{quanty}',[PageController::class,'SaveItemListCart'])->name('banhang.update');
Route::post('Save-All',[PageController::class,'SaveAllListItemCart'])->name('banhang.Saveall');

Route::get('add-to-favourite/{id}',[PageController::class,'addToFavourite'])->name('banhang.addToFavourite');
Route::get('del-favourite/{id}',[PageController::class,'delFavouriteItem'])->name('banhang.xoaFavourite');

Route::get('checkout',[PageController::class,'getCheckout'])->name('banhang.getdathang');
Route::post('checkout',[PageController::class,'postCheckout'])->name('banhang.postdathang');

//đăng ký
Route::get('signup',[PageController::class,'getSignin'])->name('getsignin');
Route::post('signup',[PageController::class,'postSignin'])->name('postsignin');

Route::get('/admin/dangnhap',[UserController::class,'getLogin'])->name('admin.getLogin');
Route::post('/admin/dangnhap',[UserController::class,'postLogin'])->name('admin.postLogin');
Route::get('/admin/dangxuat',[UserController::class,'getLogout'])->name('admin.getLogout');


Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
    Route::group(['prefix' => 'category'], function () {
        // admin/category/danhsach

        Route::get('danhsach',[CategoryController::class,'getCateList'])->name('admin.getCateList');
        // admin/category/them
        Route::get('them',[CategoryController::class,'getCateAdd'])->name('admin.getCateAdd');
        Route::post('them',[CategoryController::class,'postCateAdd'])->name('admin.postCateAdd');
        Route::delete('xoa/{id}',[CategoryController::class,'getCateDelete'])->name('admin.getCateDelete');
        Route::get('sua/{id}',[CategoryController::class,'getCateEdit'])->name('admin.getCateEdit');
        Route::put('sua/{id}',[CategoryController::class,'postCateEdit'])->name('admin.postCateEdit');
    });
   
    //còn nữa các route về crud product,user,bill
    Route::group(['prefix' => 'bill'], function () {
        Route::get('getdanhsach', [PageController::class, 'bill'])->name('admin.getBillList');
        Route::get('sua/{id}',[BillController::class,'getBillEdit'])->name('admin.getBillEdit');
        Route::put('sua/{id}',[BillController::class,'postBillEdit'])->name('admin.postBillEdit');
        Route::delete('xoa/{id}',[BillController::class,'getBillDelete'])->name('admin.getBillDelete');
    });
    Route::group(['prefix' => 'product'], function () {
        Route::get('danhsach', [ProductsController::class, 'getProductList'])->name('admin.getProductList');
        Route::get('them',[ProductsController::class,'getProductAdd'])->name('admin.getProductAdd');
        Route::post('them',[ProductsController::class,'postProductAdd'])->name('admin.postProductAdd');
        Route::delete('xoa/{id}',[ProductsController::class,'getProductDelete'])->name('admin.getProductDelete');
        Route::get('sua/{id}',[ProductsController::class,'getProductEdit'])->name('admin.getProductEdit');
        Route::put('sua/{id}',[ProductsController::class,'postProductEdit'])->name('admin.postProductEdit');
    });
    Route::group(['prefix' => 'banner'], function () {
        Route::get('danhsach', [BannerController::class, 'getBannerList'])->name('admin.getBannerList');
        Route::get('them',[BannerController::class,'getBannerAdd'])->name('admin.getBannerAdd');
        Route::post('them',[BannerController::class,'postBannerAdd'])->name('admin.postBannerAdd');
        Route::delete('xoa/{id}',[BannerController::class,'getBannerDelete'])->name('admin.getBannerDelete');
        Route::get('sua/{id}',[BannerController::class,'getBannerEdit'])->name('admin.getBannerEdit');
        Route::put('sua/{id}',[BannerController::class,'postBannerEdit'])->name('admin.postBannerEdit');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('danhsach', [UserController::class, 'index'])->name('admin.getUserList');
        Route::get('sua/{id}',[UserController::class,'getUserEdit'])->name('admin.getUserEdit');
        Route::put('sua/{id}',[UserController::class,'postUserEdit'])->name('admin.postUserEdit');
        Route::delete('xoa/{id}',[UserController::class,'getUserDelete'])->name('admin.getUserDelete');
    });
    
    Route::group(['prefix' => 'customer'], function () {
        Route::get('danhsach', [CustomerController::class, 'index'])->name('admin.getCustomerList');
        Route::get('sua/{id}',[CustomerController::class,'getCustomerEdit'])->name('admin.getCustomerEdit');
        Route::put('sua/{id}',[CustomerController::class,'postCustomerEdit'])->name('admin.postCustomerEdit');
        Route::delete('xoa/{id}',[CustomerController::class,'getCustomerDelete'])->name('admin.getCustomerDelete');
    });
   
    Route::get('index', [PageController::class, 'IndexAdmin'])->name('admin.index');

})->middleware('auth');
Route::get('/lienhe', [PageController::class, 'getlienhe'])->name('getlienhe');

Route::post('/lienhe', [PageController::class, 'postlienhe'])->name('postlienhe');

Route::get('contact', function () { return view('contact');})->name('contact');
