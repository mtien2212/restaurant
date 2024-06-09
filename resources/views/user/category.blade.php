<head>
    <style>
        .title{
            text-align: center;
            color: orange;
            font-size: 2.5vw;
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
        .category ul{
            display: flex;
            justify-content: center;
        }
        .category ul a{
            text-decoration: none;
            color: black;
            font-size: 1.2vw;
        }
        .category li:hover{
            background-color: red;
            color: white;
        }
        .category li{
            list-style: none;
            padding: 5px 30px;
            margin-right: 20px;
            border: solid 2px;
            border-radius: 30px;
            border-color: red;
        }
    </style>
</head>
<html>
    @extends('layouts.user')
    @section('banner')
        <img src="image/thucdonlau.png" width="100%">
    @endsection
    @section('content')
        <p class="title">
            Thực đơn lẩu
        </p>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="category">
                    <ul>
                        @foreach ($listCategory as $item)
                            <a href="/thucdonlau?id={{ $item->maloaisanpham }}"><li>{{ $item->tenloaisanpham }}</li></a>
                        @endforeach
                    </ul>
                </div>
                <div class="row">
                    @foreach($listProduct as $item)
                    <div class="col-4">
                        <img src="image/{{ $item->hinhanh }}" height="80%" width="100%"><br>
                        <p class="product">{{ $item->tensanpham }}</p>
                        <p class="price"><span class="money">{{ $listPrice[$item->masanpham] }}</span>&#8363<br><a href="/themvaogio?idsp={{ $item->masanpham }}" class="buy">Mua ngay</a></p>
                        <p> </p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    @endsection
</html>