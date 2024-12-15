<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 180 Cao Lỗ</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0987 65 4321</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if (Auth::check())
                        <li><a><i class="fa fa-user"></i> Chào bạn {{Auth::user()->full_name}}</a></li>
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
            <div class="pull-left">
                <a href="{{route('/')}}" id="logo"><img src="/source/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
</div> <!-- #header -->
