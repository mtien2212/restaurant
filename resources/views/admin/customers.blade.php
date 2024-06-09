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
       Danh sách khách hàng
       @endsection
       @section('content')
       <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr align="center" valign="top">
              <th>ID</th>
              <th>Tên khách hàng</th>
              <th>Tuổi</th>
              <th>Giới tính</th>
              <th>SDT</th>
              <th>Email</th>
              <th>Địa chỉ</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listCustomer as $item)
            <tr>
                <td>{{ $item->makhachhang }}</td>
                <td>{{ $item->tenkhachhang }}</td>
                <td>{{ $item->tuoi }}</td>
                <td>{{ $item->gioitinh }}</td>
                <td>{{ $item->sdt }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->diachi }}</td>
                @if($item->trangthai == 1)
                <td>Đang hoạt động</td>
                <td>
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->makhachhang }}"><i class="bi bi-trash"></i>Vô hiệu hóa</button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->makhachhang }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/xoakhachhang">
                              <div>Bạn có chắc chắc vô hiệu hóa: {{ $item->tenkhachhang }}</div>
                                <input type="hidden" class="form-control" id="name" name="name" value="{{ $item->tendangnhap }}">
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                              </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Xoa -->
                </td>
                @endif
                @if($item->trangthai == 0)
                <td>Không hoạt động</td>
                <td>
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->makhachhang }}"><i class="bi bi-trash"></i>Kích hoạt</button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->makhachhang }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/kichhoatkhachhang">
                              <div>Bạn có chắc chắc kích hoạt: {{ $item->tenkhachhang }}</div>
                                <input type="hidden" class="form-control" id="name" name="name" value="{{ $item->tendangnhap }}">
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                              </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Xoa -->
                </td>
                @endif
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
       @endsection
  
    </body>
</html>

