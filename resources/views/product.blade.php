@extends('layouts.master')
@section('css')
<title>BetaDesign &mdash; Product</title>
<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="/source/assets/dest/css/font-awesome.min.css">
<link rel="stylesheet" href="/source/assets/dest/vendors/colorbox/example3/colorbox.css">
<link rel="stylesheet" title="style" href="/source/assets/dest/css/style.css">
<link rel="stylesheet" href="/source/assets/dest/css/animate.css">
<link rel="stylesheet" title="style" href="/source/assets/dest/css/huong-style.css">
@endsection

@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Product</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{route('/')}}">Home</a> / <span>Product</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="row">
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-5">
                        <img src="/source/image/product/{{$product['image']}}" alt="{{$product['name']}}" class="img-responsive" />
                    </div>
                    <div class="col-sm-7">
                        <div class="product-details">
                            <h2 class="product-title">{{$product['name']}}</h2>

                            @if ($product->promotion_price != 0)
                            <div class="product-price">
                                <span class="old-price">{{number_format($product->unit_price)}}</span>
                                <span class="current-price">{{number_format($product->promotion_price)}}</span>
                            </div>
                            @else
                            <div class="product-price">
                                <span class="current-price">{{number_format($product->unit_price)}}</span>
                            </div>
                            @endif

                            <div class="product-description">
                                <p>{{$product['description']}}</p>
                            </div>

                            <div class="product-options">
                                <label for="size">Size:</label>
                                <select class="wc-select" name="size" id="size">
                                    <option>Size</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                </select>

                                <label for="qty">Quantity:</label>
                                <select class="wc-select" name="qty" id="qty">
                                    <option>Qty</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>

                                <a class="add-to-cart btn btn-primary" href="{{route('banhang.addToCart',$product->id)}}"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space40"></div>

                <div class="woocommerce-tabs">
                    <ul class="tabs">
                        <li><a href="#tab-description">Description</a></li>
                    </ul>

                    <div class="panel" id="tab-description">
                        <p>{{$product['description']}}</p>
                    </div>
                </div>

                <div class="space50"></div>

                <div class="beta-products-list">
                    <h4>Related Products</h4>

                    <div class="row">
                        @foreach ($related as $item)
                        <div class="col-sm-4">
                            <div class="single-item">
                                <div class="single-item-header">
                                    <a href="{{route('product',['id'=>$item->id]) }}"><img src="/source/image/product/{{$item->image}}" alt="{{$item->name}}" class="img-responsive"></a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{$item->name}}</p>
                                    @if ($item->promotion_price != 0)
                                    <p class="single-item-price">
                                        <span class="flash-del">{{number_format($item->unit_price)}}</span>
                                        <span class="flash-sale">{{number_format($item->promotion_price)}}</span>
                                    </p>
                                    @else
                                    <p class="single-item-price">
                                        <span>{{number_format($item->unit_price)}}</span>
                                    </p>
                                    @endif
                                </div>
                                <div class="single-item-caption">
                                    <a class="add-to-cart pull-left" href="{{route('banhang.addToCart',$item->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="beta-btn primary" href="{{route('product',['id'=>$item->id]) }}">Details <i class="fa fa-chevron-right"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> <!-- .beta-products-list -->
            </div>

            <div class="col-sm-3 aside">
                <div class="widget">
                    <h3 class="widget-title">Best Sellers</h3>
                    <div class="widget-body">
                        @foreach ($best_product as $item)
                        <div class="beta-sales beta-lists">
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="{{route('product',['id'=>$item->id]) }}"><img src="/source/image/product/{{$item->image}}" alt="{{$item->name}}"></a>
                                <div class="media-body">
                                    {{$item->name}}
                                    @if ($item->promotion_price != 0)
                                    <span class="beta-sales-price">{{number_format($item->promotion_price)}}</span>
                                    @else
                                    <span class="beta-sales-price">{{number_format($item->unit_price)}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> <!-- best sellers widget -->

                <div class="widget">
                    <h3 class="widget-title">New Products</h3>
                    <div class="widget-body">
                        @foreach ($new_product as $item)
                        <div class="beta-sales beta-lists">
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="{{route('product',['id'=>$item->id]) }}"><img src="/source/image/product/{{$item->image}}" alt="{{$item->name}}"></a>
                                <div class="media-body">
                                    {{$item->name}}
                                    @if ($item->promotion_price != 0)
                                    <span class="beta-sales-price">{{number_format($item->promotion_price)}}</span>
                                    @else
                                    <span class="beta-sales-price">{{number_format($item->unit_price)}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> <!-- new products widget -->
            </div>
        </div>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection

@section('js')
<script type="text/javascript">
    $(function() {
        // Highlight active menu item
        var url = window.location.href;
        $(".main-menu a").each(function() {
            if (url == (this.href)) {
                $(this).closest("li").addClass("active");
                $(this).parents('li').addClass('parent-active');
            }
        });
    });
</script>
<script>
    jQuery(document).ready(function($) {
        'use strict';

        // Colorbox
        jQuery('#style-selector').animate({
            left: '-213px'
        });

        jQuery('#style-selector a.close').click(function(e) {
            e.preventDefault();
            var div = jQuery('#style-selector');
            if (div.css('left') === '-213px') {
                jQuery('#style-selector').animate({
                    left: '0'
                });
                jQuery(this).removeClass('icon-angle-left');
                jQuery(this).addClass('icon-angle-right');
            } else {
                jQuery('#style-selector').animate({
                    left: '-213px'
                });
                jQuery(this).removeClass('icon-angle-right');
                jQuery(this).addClass('icon-angle-left');
            }
        });
    });
</script>
@endsection
