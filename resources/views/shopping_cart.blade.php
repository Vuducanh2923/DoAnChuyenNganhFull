@extends('layouts.master')
	@section('css')
    <title>BetaDesign &mdash; Shopping Cart</title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/source/assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="/source/assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" title="style" href="/source/assets/dest/css/style.css">
	<link rel="stylesheet" href="/source/assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="/source/assets/dest/css/huong-style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">

    @endsection

	
@section('content')


<div class="inner-header">
    <div class="container">
        <div id="content" id="list-cart">
            <div class="table-responsive">
                <!-- Shop Products Table -->
                <table class="table table-bordered table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Session::has('cart') && isset($productCarts))
                            @foreach ($productCarts as $product)
                                <tr>
                                    <td>
                                        <div class="media align-items-center">
                                            <img src="/source/image/product/{{$product['item']->image}}" class="mr-3 img-thumbnail" alt="{{$product['item']->name}}" style="width: 80px; height: 80px; object-fit: cover;">
                                            <div class="media-body">
                                                <h6 class="mt-0">{{$product['item']->name}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{number_format($product['item']->promotion_price ?: $product['item']->unit_price, 0)}} VND</td>
                                    <td>In Stock</td>
                                    <td>
                                        <input type="number" class="form-control text-center" id="quanty-item-{{$product['item']->id}}" value="{{$product['qty']}}" min="1" onchange="SaveListItemCart({{$product['item']->id}})">
                                    </td>
                                    <td>{{number_format(($product['item']->promotion_price ?: $product['item']->unit_price) * $product['qty'], 0)}} VND</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="DelListItemCart({{$product['item']->id}})">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center text-danger">
                                    <strong>Your cart is empty!</strong>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
    
            <!-- Cart Totals -->
            <div class="cart-totals mt-4">
                <h4>Cart Totals</h4>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Cart Subtotal:
                        <strong>{{isset($totalPrice) ? number_format($totalPrice, 0) : '0'}} VND</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Shipping:
                        <strong>Free</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Order Total:
                        <strong>{{isset($totalPrice) ? number_format($totalPrice, 0) : '0'}} VND</strong>
                    </li>
                </ul>
                <a href="/checkout" class="btn btn-primary btn-block mt-3">Proceed to Checkout</a>
            </div>
        </div>
    </div>
    
</div>


@endsection

	<!--customjs-->
	@section('js')
    <script type="text/javascript">
        $(function() {
            // this will get the full URL at the address bar
            var url = window.location.href;
    
            // passes on every "a" tag
            $(".main-menu a").each(function() {
                // checks if its the same on the address bar
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
                    
    // color box
    
    //color
          jQuery('#style-selector').animate({
          left: '-213px'
        });
    
        jQuery('#style-selector a.close').click(function(e){
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
<script>
    function SaveListItemCart(id) {
       
        $.ajax({
            url: 'SaveListItemCart/'+id+'/'+$('#quanty-item-'+id).val(),
            type: 'GET',
        }).done(function(response){
            // RenderListCart(response);
            alertify.success('đã cập nhật thành công');
            setTimeout(() => {
                location.reload();
            }, 170);
            
        });

    }
    function DelListItemCart(id) {
       
       $.ajax({
           url: 'del-cart/'+id,
           type: 'GET',
       }).done(function(response){
        //    RenderListCart(response);
           alertify.success('đã xóa thành công');
           setTimeout(() => {
                location.reload();
            }, 150);
       });

   }
    function RenderListCart(response) {
        $("#list-cart").empty();
        $("#list-cart").html(response);
    }
    $(".edit-all").on("click", function(){
     var lists = [];
     $("table tbody tr td").each(function(){
        $(this).find("input").each(function(){
            var element = {key: $(this).data("id"), value: $(this).val()};
            lists.push(element);
        });
       
     });
     $.ajax({
            url: 'Save-All',
            type: 'POST',
            data: {
                "_token" : "{{csrf_token()}}",
                "data" : lists

            } 
        }).done(function(response){
           
            // RenderListCart(response);
            alertify.success('đã cập nhật thành công');
            setTimeout(() => {
                location.reload();
            }, 200);
        });
 });

</script>
       
        <!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    @endsection
