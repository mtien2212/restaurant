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
            padding: 10px;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            margin: 5px;
        }
        .buy:hover{
            color: yellow;
        }
    </style>
</head>
<body>
    @extends('layouts.user')
    @section('banner')
        </div><img src="image/banner.png" width="100%">
    @endsection
    @section('content')
        <p class="title">
            THỰC ĐƠN LẨU NGON TẠI NHÀ
        </p>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row">
                    @foreach($listProduct as $item)
                    <div class="col-4">
                        <img src="image/{{ $item->hinhanh }}" height="70%" width="100%"><br>
                        <p class="product">{{ $item->tensanpham }}</p>
                        <p class="price"><span class="money">{{ $listPrice[$item->masanpham] }}</span>&#8363<br>
                            <a href="/themvaogio?idsp={{ $item->masanpham }}" class="buy">Thêm vào giỏ hàng</a>
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-1"></div>
        </div>
        
    @endsection
    </body>