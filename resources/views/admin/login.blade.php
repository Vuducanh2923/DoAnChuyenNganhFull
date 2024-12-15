@extends('layouts.footeronly')
@section('css')
<title>BetaDesign </title>
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
    @if (Session::has('flag') )
    <div class="alert alert-{{session('flag')}}">
        {{ session('thongbao') }}
    </div>
    @endif   
    <div id="content">
        
        <form action="{{route('admin.postLogin')}}" method="post" class="beta-form-checkout">
            @csrf
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h4>Đăng nhập</h4>
                    <div class="space20">&nbsp;</div>

                    
                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input name="email" type="email" id="email" required>
                    </div>
                    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    <div class="form-block">
                        <label for="phone">Password*</label>
                        <input name="password" type="password" class="form-control" id="pwd" required>
                    </div>
                    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    <div class="form-block">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->

@endsection
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
        
        @if(Session('flag')=='alert')
        alert(Session('thongbao'))
      
        @endif
    </script>
@endsection