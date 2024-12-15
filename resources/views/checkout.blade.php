@extends('layouts.master')
@section('css')
<title>Đặt hàng</title>
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
    		
	<div class="container">
		@if (session('success'))
		<div class="alert alert-success">
			{{session('success')}}
		</div>
		@endif
		<div id="content">
			
			<form action="{{route('banhang.postdathang')}}" method="post" class="beta-form-checkout">
				@csrf
				<div class="row">
					<div class="col-sm-6">
						<h4>Đặt hàng</h4>
						@if (Auth::check())
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="name">Họ tên*</label>
							<input type="text" name="name" id="name" value="{{Auth::user()->full_name}}" placeholder="Họ tên" required>
						</div>
						<div class="form-block">
							<label for="adress">Địa chỉ*</label>
							<input type="text" id="adress" name="address" value="{{Auth::user()->address}}" placeholder="Street Address" required>
						</div>		
						<div class="form-block">
							<label for="phone">Điện thoại*</label>
							<input type="text" name="phone_number" value="{{Auth::user()->phone}}" id="phone" required>
						</div>
						<div class="form-block">
							<label for="notes">Ghi chú</label>
							<textarea id="notes" name="note"></textarea>
						</div>
						@else
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="name">Họ tên*</label>
							<input type="text" name="name" id="name" placeholder="Họ tên" required>
						</div>
						<div class="form-block">
							<label for="adress">Địa chỉ*</label>
							<input type="text" id="adress" name="address" placeholder="Street Address" required>
						</div>
						

						<div class="form-block">
							<label for="phone">Điện thoại*</label>
							<input type="text" name="phone_number" id="phone" required>
						</div>
						
						<div class="form-block">
							<label for="notes">Ghi chú</label>
							<textarea id="notes" name="note"></textarea>
						</div>
						@endif
					</div>
					

					<div class="col-sm-6">
						<div class="your-order">
							<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
							<div class="your-order-body" style="padding: 0px 10px">
								<div class="your-order-item">
									<div>
									<!--  one item	 -->
									@isset($productCarts)
                                
                           
									@foreach ($productCarts as $product)
										<div class="media">
											<img width="25%" src="/source/image/product/{{$product['item']->image}}" alt="" class="pull-left">
											<div class="media-body">
												<p class="font-large">{{$product['item']->name}}</p>
												<span class="color-gray your-order-info">Color: Red</span>
												<span class="color-gray your-order-info">Size: M</span>
												<span class="color-gray your-order-info">Qty: {{$product['qty']}}*<span>{{$product['item']->promotion_price !=0?number_format($product['item']->promotion_price,0):
													number_format($product['item']->unit_price,0)
													 }}</span>
											</div>
										</div>
									@endforeach
									@endisset
									<!-- end one item -->
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
									<div class="pull-right"><h5 class="color-black">                                  {{isset($totalPrice)?number_format($totalPrice):0}}
									</h5></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="your-order-head"><h5>Hình thức thanh toán COD</h5></div>
							
							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
										</div>						
									</li>
									
								</ul>
							</div>

							<div class="text-center"><button class="beta-btn primary" type="submit" >Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->

@endsection


	
@section('js')
    <!--customjs-->
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
@endsection