<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a ><i class="fa fa-home"></i>180 Cao Lỗ </a></li>
                    <li><a ><i class="fa fa-phone"></i> 0987 65 4321</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if (Auth::check())
                    <li><a><i class="fa fa-user"></i>Chào bạn {{Auth::user()->full_name}}</a></li>
                    <li><a href="{{route('admin.getLogout')}}">Đăng xuất</a></li>
                   @else           
                    <li><a href="{{route('getsignin')}}">Đăng kí</a></li>
                    <li><a href="{{route('admin.getLogin')}}">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #ff8800;">
        <div class="container justify-content-center">
            <a class="visible-xs beta-menu-toggle pull-right" href="#">
                <span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i>
            </a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{route('/')}}">Trang chủ</a></li>
                    <li><a href="{{route('products')}}">Sản phẩm</a>
                        <ul class="sub-menu">
                            @foreach ($type_products as $type)
                            <li><a href="{{route('products',['key'=>$type->name])}}">{{$type->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{route('contact')}}">Giới thiệu</a></li>
                    <li><a href="{{route('getlienhe')}}">Bản đồ</a></li>
                </ul>
            </nav>
    
            <!-- Form tìm kiếm -->
            <div class="beta-comp">
                <form role="search" id="searchform" action="{{route('products')}}">
                    <input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..." />
                    <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                </form>
            </div>
    
            <!-- Giỏ hàng -->
            <div class="beta-comp">
                <div class="cart">
                    <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (
                        @if (Session::has('cart'))
                        {{Session('cart')->totalQty}}
                        @else
                            trống
                        @endif
                    ) <i class="fa fa-chevron-down"></i></div>
                    <div class="beta-dropdown cart-body">
                        @isset($productCarts)
                        @foreach ($productCarts as $product)
                        <div class="cart-item">
                            <a class="cart-item-delete" href="{{ route('banhang.xoagiohang',$product['item']['id'])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                </svg>
                            </a>
                            <div class="media">
                                <a class="pull-left" href="#"><img src="/source/image/product/{{$product['item']->image}}" alt=""></a>
                                <div class="media-body">
                                    <span class="cart-item-title">{{$product['item']->name}}</span>
                                    <span class="cart-item-amount">{{$product['qty']}}*<span>{{$product['item']->promotion_price !=0?number_format($product['item']->promotion_price,0):number_format($product['item']->unit_price,0)}}</span></span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endisset
                        <div class="cart-caption">
                            <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">
                                {{isset($totalPrice)?number_format($totalPrice):0}}
                            </span></div>
                            <div class="clearfix"></div>
                            <div class="center">
                                <div class="space10">&nbsp;</div>
                                <a href="{{route('banhang.getdathang')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                <a href="{{route('shopping_cart')}}" class="beta-btn primary text-center">Xem chi tiết <i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="clearfix"></div>
        </div>
    </div>    
</div> <!-- #header -->
