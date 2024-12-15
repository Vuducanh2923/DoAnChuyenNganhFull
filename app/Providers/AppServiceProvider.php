<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Favourite;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Type_products;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {
            $view->with([
                'type_products' => Type_products::orderBy('name', 'ASC')->get(),
                'slides' => Slide::all(),
              'new_product' => Product::where('new','=','1')->inRandomOrder()->limit('4')->get(),
              'best_product' => Product::where('best','=','1')->inRandomOrder()->limit('4')->get(),
                
                
            ]);
            if(Session('cart')){
                $oldCart=Session::get('cart'); //session cart được tạo trong method addToCart của PageController
                $cart=new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'productCarts'=>$cart->items,
                'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            };
            if(Session('favourite')){
                $oldFavourite=Session::get('favourite'); //session cart được tạo trong method addToCart của PageController
                $favourite=new Favourite($oldFavourite);
                $view->with(['favourite'=>Session::get('favourite'),'productFavourites'=>$favourite->items,
                ]);
            };
        });
    }
}
