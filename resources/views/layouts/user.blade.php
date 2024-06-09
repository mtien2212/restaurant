<html>
    <head>
        <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            *{
                padding: 0px;
                margin: 0px;
            }
            ul{
                list-style: none;
                display: flex;
                justify-content: flex-start;
            }
            a{
                text-decoration: none;
                color: black;
            }
            li{
                font-size: 1.3vw;
                font-weight: bold;
                padding-top: 25px;
                padding-right: 20px;
                padding-left: 20px;
            }
            .header .icon{
                font-size: 2.5vw;
                padding-top: 15px;
                text-align: center;
                display: flex;
                justify-content: flex-start;
            }
            .user{
                
            }
            .user_inf{
                display: none;
                position:absolute;
                margin-left: -80px; 
            }
            .user_li{
                display: block;
                border: solid 2px;
                margin: 0;
                padding: 5px;
                font-size: 15px;
                width: 150px;
                background-color: white;
                text-align: center;
            }
            .user_li:hover{
                background-color: red;
                color: white;
            }
            .user:hover .user_inf{
                display: flex;
                flex-direction: column;
                
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="row">
                <div class="col-1"><a href="/"><img src="image/logo.png" width="70%"></a></div>
                <div class="col-9">
                    <div class="menu">
                        <ul>
                            <li><a href="/thucdonlau?id=3">Thực đơn lẩu</a></li>
                            <li>|</li>
                            <li><a href="/datban?date=">Đặt bàn</a></li>
                            <li>|</li>
                            <li><a href="/gioithieu">Giới thiệu</a></li>
                            <li>|</li>
                            <li><a href="/tintuc">Tin tức</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-1">
                    <div class="user">
                        <div class="icon"> 
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <ul class="user_inf">
                            @if(!session('user'))
                            <a  href="/dangnhap"><li class="user_li">Đăng nhập</li></a>    
                            @else
                            <a  href="/trangcanhan"><li class="user_li">Trang cá nhân</li></a>
                            <a  href="/lichsumuahang"><li class="user_li">Lịch sử mua hàng</li></a>
                            <a  href="/lichsudatban"><li class="user_li">Lịch sử đặt bàn</li></a>
                            <a  href="/dangxuat"><li class="user_li">Đăng xuất</li></a>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-1"><div class="icon"><a  href="/giohang"><i class="bi bi-bag"></i></a></div></div>      
        </div>
        <div class="banner">
            @yield('banner')
        </div>
        <div class="contents">
            @yield('content')
        </div>
        <div class="footer">
            <img src="image/footer.png" width="100%">
        </div>
        <script src="/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="/js/simple.money.format.js"></script>
        <script> $('.money').simpleMoneyFormat(); </script>
    </body>
</html>
