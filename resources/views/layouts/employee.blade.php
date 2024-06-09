<html>
    <head>
        <link href="../bootstrap-5.0.2-dist/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .layout{
                margin: 0px;
                padding: 0px;
                width: 100%;
                background-color: lightgrey;
                min-height: 700px;
            }
            .head{
                display: flex;
                justify-content: space-between;
                font-size: 30px;
                padding-left: 20px;
                padding-top: 20px;
                margin: 30px;
                border-radius: 10px;
                background-color: white;
            }
            .icon{
                padding-right: 40px;
            }
            .menu{
                width: 100%;
                height: 100%;
                min-height: 600px;
                background-color:white;
                border-radius: 10px;
                margin: 30px;
            }
            .container{
                background-color: red;
                width: 100%;
            } 
            ul{
                padding: 10px 30px;
                margin: 0px;
            }
            li{
                list-style: none;
                color: black;
                padding: 5px;
                padding-left: 15px;
                text-align: start;
                border-radius: 10px;
            }
            li:hover{
                background-color:mistyrose;
                color: red;
            }
            .content{
                background-color:white;
                border-radius: 10px;
                margin: 30px;
                padding: 20px;
            }
            .title{
                padding-left: 15px;
                color: red;
                font-weight: bold;
            }
            a{
                text-decoration: none;
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
        <div class="layout">
            <div class="row">
                <div class="col-2" style="padding-right: 0px;">
                    <div class="menu">
                        <div class="logo"><img src="../image/logo.png" width="50%"></div>
                        <div class="title"><i class="bi bi-headphones"></i>TỔNG ĐÀI</div>
                        <ul>
                            <a href="/nhanvien/duyetdon"><li>Duyệt đơn</li></a>
                            <a href="/nhanvien/datban"><li>Đặt bàn</li></a>
                        </ul>
                        <div class="title"><i class="bi bi-thermometer-high"></i>ĐẦU BẾP</div>
                        <ul>
                            <a href="/nhanvien/antaiquan"><li>Món ăn tại quán</li></a>
                            <a href="/nhanvien/antainha"><li>Đơn ăn tại nhà</li></a>
                        </ul>
                        <div class="title"><i class="bi bi-clipboard"></i>PHỤC VỤ</div>
                        <ul>
                            <a href="/nhanvien/order"><li>Order</li></a>
                            <a href="/nhanvien/lenmon"><li>Lên món</li></a>
                        </ul>
                        <div class="title"><i class="bi bi-truck"></i>VẬN CHUYỂN</div>
                        <ul>
                            <a href="/nhanvien/shipdon"><li>Ship đơn</li></a>
                        </ul>
                    </div>
                </div>
                <div class="col-10">
                    <div class="head"><p>@yield('head')</p><div class="user">
                        <div class="icon"> 
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <ul class="user_inf">
                            <a  href="/dangxuat"><li class="user_li">Đăng xuất</li></a>
                        </ul>
                    </div></div>
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div> 
        <script src="../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="../js/simple.money.format.js"></script>
        <script> $('.money').simpleMoneyFormat(); </script>
    </body>
</html>
