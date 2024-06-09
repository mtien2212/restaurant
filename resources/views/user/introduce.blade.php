<head>
    <style>
        .title{
            text-align: center;
            color: orange;
            font-size: 2vw;
            font-weight: bold;
        }
        .product{
            text-align: center;
            font-weight: bold;
            font-size: 1.3vw;
            padding: 0px;
            margin: 0px;
        }     
        .price{
            text-align: center;
            color: red;
            font-size: 1.3vw;
        }
        .buy{
            display: inline-block;
            background-color: red;  
            padding: 5px;
            border-radius: 10px;
            text-decoration: none;
            color: white;
        }
        .buy:hover{
            color: yellow;
        }
    </style>
</head>
<body>
    @extends('layouts.user')
    @section('banner')
        <img src="image/introduce.png" width="100%">
    @endsection
    @section('content')
        <p class="title">
            LẨU NGON TẠI NHÀ – YÊN TÂM ĂN UỐNG MỖI NGÀY
        </p>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row">
                    <div class="col-5">&emsp;Nếu bạn đang tìm kiếm một địa điểm ăn lẩu hoặc nướng ngon tại nhà, thì Eat House Lẩu Ngon Tại Nhà chắc chắn sẽ là sự lựa chọn hàng đầu. <br> &emsp; Với nhiều năm kinh nghiệm trong lĩnh vực ẩm thực, Eat House Lẩu Ngon Tại Nhà đã trở thành một trong những thương hiệu lẩu nổi tiếng tại Hà Nội và được nhiều khách hàng đánh giá cao.

                        <br> &emsp;Với phương châm “Khách hàng luôn là thượng đế”, Eat House Lẩu Ngon Tại Nhà cam kết sử dụng các nguyên liệu tươi ngon nhất để tạo ra các loại lẩu đa dạng và hương vị đậm đà. Bên cạnh đó, thực đơn của Eat House Lẩu Ngon Tại Nhà vô cùng phong phú với rất nhiều loại lẩu và toping giúp khách hàng thoải mái lựa chọn, và mang lại một trải nghiệm ẩm thực đặc biệt và thú vị.
                        
                        <br> &emsp;Với dịch vụ giao hàng đến tận nhà, Eat House Lẩu Ngon Tại Nhà luôn đáp ứng được nhu cầu đa dạng của khách hàng. Bất kể bạn đang tổ chức tiệc tại gia hoặc muốn thưởng thức một bữa ăn lẩu ngon trong một không gian ấm cúng và đầy thân thiện hay đi dã ngoại picnic, Eat House Lẩu Ngon Tại Nhà luôn sẵn sàng phục vụ.
                        
                        <br> &emsp;Với những lợi ích trên, Eat House Lẩu Ngon Tại Nhà không chỉ đáp ứng được nhu cầu thưởng thức ẩm thực tại nhà, mà còn mang tới cho thực khách một trải nghiệm tuyệt vời về hương vị và dịch vụ chuyên nghiệp. Hãy ghé thăm Eat House Lẩu Ngon Tại Nhà và đặt lẩu nướng về nhà thôi nào các bạn.</div>
                    <div class="col-1"></div>
                    <div class="col-3">
                        <img src="image/introduce1.jpg" width="100%"><img src="image/introduce2.jpg" width="100%">
                    </div>
                    <div class="col-3">
                        <img src="image/introduce3.jpg" width="100%"><img src="image/introduce4.jpg" width="100%">
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
        <p></p>
    @endsection
    </body>