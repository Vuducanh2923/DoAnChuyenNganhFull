<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        {{-- <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> --}}
        @yield('css')
        
    </head>
    <body class="sb-nav-fixed">
                @include('admin.layout_admin.header')
	@yield('content')
	@include('admin.layout_admin.footers')
	<!--customjs-->
	@yield('js')
                
  
    </body>
</html>
