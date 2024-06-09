<html>
    <head>
        <link href="../bootstrap-5.0.2-dist/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            body{
                margin: 10px;
            }
            .title{
                font-weight: bold;
                font-size: 30px;
                padding: 5px;
                text-align: start;
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
                text-align: center;
                list-style: none;
                padding: 5px 10px;
                min-width: 100px;
                margin-right: 20px;
                border: solid 2px;
                border-radius: 30px;
                border-color: red;
            }
            .name{
                text-align: center;
                font-weight: bold;
                font-size: 0.9vw;
                padding: 0px;
                margin: 0px;
            }     
            .price{
                text-align: center;
            }
            .buy{
                background-color: red;
                color: white;
                width: 100%;
                height: 30px;
                border-radius: 5px;
            }
            .product{
                margin: 10px;
                box-shadow: 5px 10px #888888;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-8">
                <div class="title"><a href="/nhanvien/order"><i class="bi bi-arrow-left-short"></i></a>Menu</div>
                <div class="category">
                    <ul>
                        @foreach ($listCategory as $item)
                            <a href="/nhanvien/themmon?id={{ $item->maloaisanpham }}&idb={{ $idb }}"><li>{{ $item->tenloaisanpham }}</li></a>
                        @endforeach
                    </ul>
                </div>
                <div class="row">
                    @foreach($listProduct as $item)
                    <div class="col-3">
                        <div class="shadow p-3 mb-5 bg-body rounded">
                            <img src="../image/{{ $item->hinhanh }}" width="100%" height="200px"><br>
                            <p class="name">{{ $item->tensanpham }}</p>
                            <p class="price"><span class="money">{{ $listPrice[$item->masanpham] }}</span>&#8363<br><a href="/nhanvien/datmon?id={{ $item->masanpham }}&iddh={{ $iddh[0]->madonhang }}"=><button class="buy"><i class="bi bi-plus"></i></button></a></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-4">
                <div class="title">Đơn hàng</div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr align="center" valign="top">
                          <th>Tên sản phẩm</th>
                          <th>Số lượng</th>
                          <th>Đơn giá</th>
                          <th>Thao tác</th>
                      </thead>
                      <tbody>
                        @foreach ($allProduct as $item)
                        <tr>
                            @if($item->trangthai == "Đang nấu")
                            <td>{{ $item->tensanpham}}</td>
                            <td align="center"><a href="/nhanvien/thaydoisoluong?quality={{ $item->soluong - 1 }}&iddh={{ $iddh[0]->madonhang }}&id={{ $item->masanpham }}"><i class="bi bi-dash-circle"></i></a> {{ $item->soluong }} <a href="/nhanvien/thaydoisoluong?quality={{ $item->soluong + 1 }}&iddh={{ $iddh[0]->madonhang }}&id={{ $item->masanpham }}"><i class="bi bi-plus-circle"></i></a></td>
                            <td ><span class="money">{{ $item->dongia* $item->soluong }}</span>&#8363;</td>
                            </td>
                            <td>
                              <!-- Button Xoa -->
                                <a href="/nhanvien/xoamon?id={{ $item->masanpham }}&iddh={{ $iddh[0]->madonhang }}"><button type="button" class="btn btn-danger"><i class="bi bi-x"></i></button></a>
                            </td> 
                            @else
                            <td>{{ $item->tensanpham}}</td>
                            <td align="center">{{ $item->soluong }}</td>
                            <td ><span class="money">{{ $item->dongia }}</span>&#8363;</td>
                            </td>
                            <td>
                              
                            </td> 
                            @endif
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal">Thanh toán</button>
                        <!-- Them moi -->
                        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thanh toán đơn hàng mã: {{ $iddh[0]->madonhang }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form method="GET" action="/nhanvien/thanhtoan">
                                    <label>Hình thức thanh toán:</label>
                                    <select name="payment">
                                        <option>Thanh toán trực tiếp</option>
                                        <option>Thanh toán trực tuyến</option>
                                    </select></br>
                                    <label>Mã giảm giá:</label>
                                    <input type="text" name="code" id="code">
                                    <input type="hidden" id="id" name="id" value="{{ $iddh[0]->madonhang }}"><br>
                                    <button type="submit" class="btn btn-danger">Thanh toán</button>
                                </form>
                              </div>
                            </div>
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