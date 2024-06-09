<html lang="vie">
    <head>
       <style>
            .new{
                display: flex;
                justify-content: space-between;
                margin: 10px;
            }
       </style>
    </head>
    <body>
       @extends('layouts.employee')
       @section('head')
       Danh sách đơn hàng cần duyệt
       @endsection
       @section('content')
       <!-- Button them moi -->
       <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr align="center" valign="top">
              <th>ID</th>
              <th>Tên người nhận</th>
              <th>Địa chỉ nhận</th>
              <th>Thời gian</th>
              <th>SDT</th>
              <th>Ghi chú</th>
              <th>Hình thức thanh toán</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listInvoice as $item)
            <tr>
                <td>{{ $item->madonhang}}</td>
                <td>{{ $item->tennguoinhan}}</td>
                <td>{{ $item->diachinhan }}</td>
                <td>{{ $item->thoigian }}</td>
                <td>{{ $item->sdt }}</td>
                <td>{{ $item->ghichu }}</td>
                <td>{{ $item->hinhthucthanhtoan }}</td>
                <td>{{ $item->trangthai }}</td>
                <td>
                  <!-- Button them moi -->
                  <div class="new"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id{{ $item->madonhang }}"><i class="bi bi-eye"></i></button></div>
                  <!-- Them moi -->
                  <div class="modal fade" id="id{{ $item->madonhang }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="table-responsive" >
                            <table class="table table-bordered" >
                              <thead align="center">
                                <tr >
                                  <th>Sản phẩm</th>
                                  <th>Thành tiền</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($listProduct[$item->madonhang] as $a)
                                <tr>
                                  <td>{{ $a->tensanpham }} x {{ $a->soluong }}</td>
                                  <td><span class="money">{{ $listPrice[$a->masanpham]*$a->soluong }}</span>&#8363;</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Phí ship</td>
                                    <td><span class="money">30000</span>&#8363;</td>
                                </tr>
                                @if ( $item->phantram != 0)
                                <tr>
                                  <td>Giảm giá</td>
                                  <td>{{ $item->phantram }}%</td>
                                </tr>
                                <tr>
                                  <td>Tổng tiền</td>
                                  <td><span class="money">{{ ($total[$item->madonhang]+30000) * (100 - $item->phantram)/100 }}</span>&#8363;</td>
                                </tr>
                                @else
                                <tr>
                                  <td>Tổng tiền</td>
                                  <td><span class="money">{{ $total[$item->madonhang]+30000 }}</span>&#8363;</td>
                                </tr>  
                                @endif
                              </tbody>
                            </table>
                          </div>
                          <a href="/nhanvien/duyet?id={{ $item->madonhang }}"><button type="button" class="btn btn-success">Duyệt đơn</button></a>
                          <a href="/nhanvien/huy?id={{ $item->madonhang }}"><button type="button" class="btn btn-danger">Hủy đơn</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Them moi -->
                </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
       @endsection
  
    </body>
</html>

