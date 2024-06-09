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
       Danh sách tin tức
       @endsection
       @section('content')
       <!-- Button them moi -->
        <div class="new"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới</button></div>
        <!-- Them moi -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới tin tức</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="/admin/themtintuc" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                      <label for="title" class="form-label">Tiêu đề:</label>
                      <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3 mt-3">
                      <label for="content" class="form-label">Nội dung:</label>
                      <textarea class="form-control" id="content" name="content" required></textarea>
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
              <th>ID</th>
              <th>Tiêu đề</th>
              <th>Nội dung</th>
              <th>Ngày đăng</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listNews as $item)
            <tr>
                <td>{{ $item->matintuc }}</td>
                <td>{{ $item->tieude }}</td>
                <td>{{ $item->noidung }}</td>
                <td>{{ $item->ngaydang }}</td>
                <td>
                  <!-- Button sua -->
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#id{{ $item->matintuc }}"><i class="bi bi-pencil"></i>Sửa</button>
                  <!-- Sua -->
                  <div class="modal fade" id="id{{ $item->matintuc }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa loại sản phẩm</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="/admin/suatintuc" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $item->matintuc }}">
                            <div class="mb-3 mt-3">
                              <label for="title" class="form-label">Tiêu đề:</label>
                              <input type="text" class="form-control" id="title" name="title" required value="{{ $item->tieude }}"> 
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="content" class="form-label">Nội dung:</label>
                              <textarea class="form-control" id="content" name="content" required>{{ $item->noidung }}</textarea>
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
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->matintuc }}"><i class="bi bi-trash"></i>Xóa</button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->matintuc }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/xoatintuc">
                              <div>Bạn có chắc chắc xóa tin tức: {{ $item->matintuc }}</div>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->matintuc }}">
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

