@extends('layouts.master')
@section('css')
<title>Giới thiệu - Baker's Alley</title>
<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="/source/assets/dest/css/font-awesome.min.css">
<link rel="stylesheet" href="/source/assets/dest/vendors/colorbox/example3/colorbox.css">
<link rel="stylesheet" href="/source/assets/dest/rs-plugin/css/settings.css">
<link rel="stylesheet" href="/source/assets/dest/rs-plugin/css/responsive.css">
<link rel="stylesheet" title="style" href="/source/assets/dest/css/style.css">
<link rel="stylesheet" href="/source/assets/dest/css/animate.css">
<link rel="stylesheet" title="style" href="/source/assets/dest/css/huong-style.css">
@endsection

@section('content')
<div class="container">
    <div id="content" class="space-top-none">
        <div class="space50">&nbsp;</div>
        <div class="row">
            <div class="space20">
                <h2>Về Bánh Công Nghệ Sài Gòn</h2>
                <div class="space20">&nbsp;</div>
                <p>
                    Baker's Alley là thương hiệu bánh ngọt hàng đầu, chuyên cung cấp những sản phẩm bánh tươi ngon và chất lượng cao. 
                    Với sứ mệnh mang lại trải nghiệm hương vị độc đáo, chúng tôi tự hào là sự lựa chọn hàng đầu của khách hàng.
                </p>
                <div class="space20">&nbsp;</div>
                <h3>Tầm nhìn và Sứ mệnh</h3>
                <p>
                    Chúng tôi cam kết cung cấp sản phẩm được làm từ nguyên liệu tươi sạch, đảm bảo an toàn và thơm ngon. 
                    Baker's Alley hướng tới trở thành thương hiệu bánh ngọt được yêu thích nhất tại Việt Nam, nơi mỗi chiếc bánh đều chứa đựng tình yêu và sự tận tâm.
                </p>
                <div class="space20">&nbsp;</div>
                <h3>Giá trị cốt lõi</h3>
                <ul>
                    <li>Chất lượng: Đảm bảo mỗi sản phẩm đều đạt tiêu chuẩn cao nhất.</li>
                    <li>Sáng tạo: Không ngừng đổi mới để mang lại những trải nghiệm mới lạ.</li>
                    <li>Tận tâm: Luôn đặt khách hàng ở vị trí trung tâm trong mọi hoạt động.</li>
                </ul>
                <div class="space20">&nbsp;</div>
                <h3>Đội ngũ của chúng tôi</h3>
                <p>
                    Đội ngũ thợ làm bánh của Baker's Alley là những người thợ tài hoa, đầy kinh nghiệm và sáng tạo, luôn nỗ lực để mang đến những sản phẩm độc đáo nhất.
                </p>
            </div>
        </div>
    </div> <!-- #content -->
</div> <!-- .container -->

@endsection

@section('js')
<script src="/source/assets/dest/js/custom2.js"></script>
<script>
    $(document).ready(function($) {    
        $(window).scroll(function(){
            if($(this).scrollTop()>150){
            $(".header-bottom").addClass('fixNav')
            }else{
                $(".header-bottom").removeClass('fixNav')
            }}
        )
    })
</script>
@endsection
