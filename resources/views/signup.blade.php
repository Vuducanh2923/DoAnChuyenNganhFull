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
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div id="content">
        
        <form action="{{route('postsignin')}}" method="post" class="beta-form-checkout">
            @csrf
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h4>Đăng kí</h4>
                    <div class="space20">&nbsp;</div>

                    
                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input name="email" type="email" id="email" required>
                    </div>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    <div class="form-block">
                        <label for="your_last_name">Fullname*</label>
                        <input name="full_name" type="text" id="your_last_name" required>
                    </div>
                    @error('full_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                    <div class="form-block">
                        <label for="adress">Address*</label>
                        <input name="address" type="text" id="adress" value="Đà Nẵng" required>
                    </div>


                    <div class="form-block">
                        <label for="phone">Phone*</label>
                        <input name="phone" type="text" id="phone" required>
                    </div>
                    <div class="form-block">
                        <label for="phone">Password*</label>
                        <input name="password" type="text" id="phone" required>
                    </div>
                    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    <div class="form-block">
                        <label for="phone">Re password*</label>
                        <input name="repassword" type="text" id="phone" required>
                    </div>
                    @error('repassword')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    <div class="form-block">
                        <button type="submit" class="btn btn-success">Register</button>
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
@endsection