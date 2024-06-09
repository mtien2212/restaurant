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
       @extends('layouts.admin')
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
              <th>Địa chỉ nhận</th>
              <th>Thời gian</th>
              <th>SDT</th>
              <th>Phí vận chuyển</th>
              <th>Giảm giá</th>
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
                <td><span class="money">{{ $item->phivanchuyen }}</span>&#8363;</td>
                <td>{{ $item->phantram }}%</td>
                <td>{{ $item->hinhthucthanhtoan }}</td>
                <td>{{ $item->trangthai }}</td>
                <td>
                  <form action="/admin/hoadon">
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->madonhang }}">
                        <button type="submit" class="btn btn-primary">Chi tiết</button>
                  </form>
                </td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
       @endsection
  
    </body>
</html>

