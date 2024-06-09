<head>
    <style>
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
        <img src="image/news.png" width="100%">
    @endsection
    @section('content')
        <p>
        </p>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                @foreach ($listNews as $item)
                <div class="row">
                    <p>{{ $item->tieude }}</p>
                    <p>{{  $item->ngaydang }}</p>
                    <p>{{ $item->noidung }}</p>
                </div>
                @endforeach
                
            </div>
            <div class="col-1"></div>
        </div>
        <p></p>
    @endsection
    </body>