<html lang="vie">
    <head>
       <style>
            .new{
                display: flex;
                justify-content: space-between;
                margin: 10px;
            }
            .message{
              visibility: hidden;
            }
            .error{
              color: red;
              visibility :visible;
            }
       </style>
       <script src="../js/category.js"></script>
    </head>
    <body>
       @extends('layouts.admin')
       @section('head')
       Danh sách giảm giá
       @endsection
       @section('content')
       <!-- Button them moi -->
        <div class="new"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới</button></div>
        <!-- Them moi -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="/admin/themgiamgia" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Mã giảm giá:</label>
                      <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Phần trăm:</label>
                      <input type="number" class="form-control" id="percent" name="percent" required>
                    </div>
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Ngày bắt đầu:</label>
                      <input type="date" class="form-control" id="start" name="start" required>
                    </div>
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Ngày kết thúc:</label>
                      <input type="date" class="form-control" id="end" name="end" required>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                      <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Them moi -->
       <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Mã giảm giá</th>
              <th>Phần trăm</th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listDiscount as $item)
            <tr>
                <td>{{ $item->magiamgia }}</td>
                <td>{{ $item->phantram }}</td>
                <td>{{ $item->ngaybatdau }}</td>
                <td>{{ $item->ngayketthuc }}</td>
                <td>
                  <!-- Button sua -->
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#id{{ $item->magiamgia }}"><i class="bi bi-pencil"></i>Sửa</button>
                  <!-- Sua -->
                  <div class="modal fade" id="id{{ $item->magiamgia }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa loại sản phẩm</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="/admin/suagiamgia" method="POST">
                            @csrf
                            <div class="mb-3 mt-3">
                              <label for="name" class="form-label">Mã giảm giá:</label>
                              <input type="text" class="form-control" id="code" name="code" value="{{ $item->magiamgia }}" required>
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="name" class="form-label">Phần trăm:</label>
                              <input type="number" class="form-control" id="percent" name="code" value="{{ $item->phantram }}" required>
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="name" class="form-label">Ngày bắt đầu:</label>
                              <input type="date" class="form-control" id="start" name="start" value="{{ $item->ngaybatdau }}" required>
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="name" class="form-label">Ngày kết thúc:</label>
                              <input type="date" class="form-control" id="end" name="end" value="{{ $item->ngayketthuc }}" required>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                              <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Sua -->
                  <!-- Button Xoa -->
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->magiamgia }}"><i class="bi bi-trash"></i>Xóa</button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->magiamgia }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/xoagiamgia">
                              <div>Bạn có chắc chắc xóa mã giảm giá: {{ $item->magiamgia }}</div>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->magiamgia }}">
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
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
       @endsection
    </body>
</html>

