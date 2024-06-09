<head>
    <style>
        .name{
            font-size: 30px;
            font-weight: bold;
            padding: 0;
            margin: 0;
        }
        .price{
            text-align: left;
            color: red;
            font-style: italic;
            font-size: 25px;
            margin: 0;
            padding: 0;
        }
        .buy{
            display: inline-block;
            padding: 5px 15px;
            border: solid 2px;
            border-color: orange;
            text-decoration: none;
            color: orange;
            font-size: 25px;
        }
        .buy:hover{
            color: white;
            background-color: red;
        }
        .ingredients{
            margin: 5px;
            padding: 0;
            font-size: 17px;
        }
    </style>
</head>
<html>
    @extends('layouts.user')
    @section('banner')
        <img src="image/banner.png" width="100%">
    @endsection
    @section('content')
        <p></p>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row">
                    <div class="col-5">
                        <img src="image/sp1.png"  width="100%">
                    </div>
                    <div class="col-7">
                        <p class="name">{{ $detail[0]->tensanpham }}</p>
                        <p class="price"><span class="money">{{ $product_price }}</span>&#8363</p>
                        
                        <p class="ingredients">Thành phần:</p>
                        @foreach ($listIngredients as $item)
                            <p class="ingredients">- {{ $item->tennguyenlieu }} {{ $item->trongluong_thetich*$item->soluong }}{{ $item->donvi }}</p>
                        @endforeach
                        <button class="buy">Thêm vào giỏ</button>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    @endsection
</html>