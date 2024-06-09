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
       Danh sách đơn hàng ăn tại nhà
       @endsection
       @section('content')
       <!-- Button them moi -->
       <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr align="center" valign="top">
              <th>ID</th>
              <th>Tên người nhận</th>
              <th>Thời gian</th>
              <th>SDT</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listInvoice as $item)
            <tr>
                <td>{{ $item->madonhang}}</td>
                <td>{{ $item->tennguoinhan}}</td>
                <td>{{ $item->thoigian }}</td>
                <td>{{ $item->sdt }}</td>
                <td>{{ $item->trangthai }}</td>
                <td>
                  <!-- Button them moi -->
                  <div class="new"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id{{ $item->madonhang }}"><i class="bi bi-eye"></i></button></div>
                  <!-- Them moi -->
                  <div class="modal fade" id="id{{ $item->madonhang }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
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
                                  <th>Số lượng</th>
                                  <th>Nguyên liệu</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($listProduct[$item->madonhang] as $a)
                                <tr>
                                  <td>{{ $a->tensanpham }}</td>
                                  <td>{{ $a->soluong }}</td>
                                  <td>
                                    @foreach($listIngredients[$a->masanpham] as $b)
                                    {{ $b->tennguyenlieu }} {{ $b->trongluong_thetich * $b->soluong }}{{ $b->donvi }}
                                    @endforeach
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                          <a href="/nhanvien/nauxong?id={{ $item->madonhang }}"><button type="button" class="btn btn-success">Hoàn thành</button></a>
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

