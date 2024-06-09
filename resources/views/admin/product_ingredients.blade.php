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
            }
            .search{
                display: flex;
                justify-content: flex-start;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-7">
                <div class="title"><a href="/admin/sanpham"><i class="bi bi-arrow-left-short"></i></a>Nguyên liệu {{ $name_product[0]->tensanpham }}</div>
                <div class="table-respo1nsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr align="center" valign="top">
                          <th>ID</th>
                          <th>Tên nguyên liệu</th>
                          <th>Trọng lượng/ Thể tích</th>
                          <th>Đơn vị</th>
                          <th>Số lượng</th>
                          <th>Đơn giá</th>
                          <th>Thành tiền</th>
                          <th>Thao tác</th>
                      </thead>
                      <tbody>
                        @foreach ($listIngredients as $item)
                        <tr>
                            <td>{{ $item->manguyenlieu }}</td>
                            <td>{{ $item->tennguyenlieu}}</td>
                            <td>{{ $item->trongluong_thetich }}</td>
                            <td>{{ $item->donvi }}</td>
                            <td align="center"><a href="/admin/thaydoisoluonggiohang?quality={{ $item->soluong - 1 }}&idkh={{ $name_product[0]->masanpham }}&idi={{ $item->manguyenlieu }}"><i class="bi bi-dash-circle"></i></a> {{ $item->soluong }} <a href="/admin/thaydoisoluongnguyenlieu?quality={{ $item->soluong + 1 }}&id={{ $name_product[0]->masanpham }}&idi={{ $item->manguyenlieu }}"><i class="bi bi-plus-circle"></i></a></td>
                            <td ><span class="money">{{ $item->dongia }}</span>&#8363;</td>
                            <td><span class="money">{{ $item->soluong * $item->dongia}}</span>&#8363;</td>
                            <td>
                              <!-- Button Xoa -->
                              <a href="/admin/xoanguyenlieusanpham?id={{ $name_product[0]->masanpham }}&idi={{ $item->manguyenlieu }}"><button type="button" class="btn btn-danger"><i class="bi bi-arrow-right"></i></button></a>
                            </td> 
                          </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">Tổng tiền:</td>
                            <td colspan="2"><span class="money">{{ $price }}</span>&#8363;</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
            </div>
            <div class="col-5">
                <div class="title">Danh sách nguyên liệu</div>
                <div class="search">
                    <form action="/admin/timkiemnguyenlieu" class="search">
                      <input type="hidden" id="id" name="id" value="{{ $name_product[0]->masanpham }}">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tên nguyên liệu...">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                 </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr align="center" valign="top">
                          <th>ID</th>
                          <th>Tên nguyên liệu</th>
                          <th>Trọng lượng/ Thể tích</th>
                          <th>Đơn vị</th>
                          <th>Đơn giá</th>
                          <th>Thao tác</th>
                      </thead>
                      <tbody>
                        @foreach ($allIngredients as $item)
                        <tr>
                            <td>{{ $item->manguyenlieu }}</td>
                            <td>{{ $item->tennguyenlieu}}</td>
                            <td>{{ $item->trongluong_thetich }}</td>
                            <td>{{ $item->donvi }}</td>
                            <td ><span class="money">{{ $item->dongia }}</span>&#8363;</td>
                            </td>
                            <td>
                              <!-- Button Xoa -->
                              <a href="/admin/themnguyenlieusanpham?id={{ $name_product[0]->masanpham }}&idi={{ $item->manguyenlieu }}"><button type="button" class="btn btn-success"><i class="bi bi-arrow-left"></i></button></a>
                            </td> 
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
            </div>
        </div>
        <script src="../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="../js/simple.money.format.js"></script>
        <script> $('.money').simpleMoneyFormat(); </script>
    </body>
</html>