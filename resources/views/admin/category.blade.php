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
       Danh sách loại sản phẩm
       @endsection
       @section('content')
       <!-- Button them moi -->
        <div class="new"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới</button></div>
        <!-- Them moi -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới loại sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="/admin/themloaisanpham" method="POST" >
                    @csrf
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Tên loại sản phẩm:</label>
                      <input type="text" class="form-control" id="name1" name="name" required maxlength="100">
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
              <th>Loại sản phẩm</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listCategory as $item)
            <tr>
                <td>{{ $item->maloaisanpham }}</td>
                <td>{{ $item->tenloaisanpham }}</td>
                @if($item->trangthai == 0)
                <td>Ngừng bán</td>
                <td>
                  <!-- Button sua -->
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#id{{ $item->maloaisanpham }}"><i class="bi bi-pencil"></i>Sửa</button>
                  <!-- Sua -->
                  <div class="modal fade" id="id{{ $item->maloaisanpham }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa loại sản phẩm</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/sualoaisanpham" name="update" method="POST">
                              @csrf
                              <div class="mb-3 mt-3">
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->maloaisanpham }}">
                                <label for="name" class="form-label">Tên loại sản phẩm:</label>
                                <input type="text" class="form-control" id="name{{ $item->maloaisanpham }}" name="name" value="{{ $item->tenloaisanpham }}" required maxlength="100">
                                <p id="errorname{{ $item->maloaisanpham }}" class="message">Tên không được để trống</p>
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
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->maloaisanpham }}"><i class="bi bi-check2"></i>Mở</button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->maloaisanpham }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/hienloaisanpham">
                              <div>Bạn có chắc chắc mở lại loại sản phẩm: {{ $item->tenloaisanpham }}</div>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->maloaisanpham }}">
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
                @else
                <td>Đang bán</td>
                <td>
                  <!-- Button sua -->
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#id{{ $item->maloaisanpham }}"><i class="bi bi-pencil"></i>Sửa</button>
                  <!-- Sua -->
                  <div class="modal fade" id="id{{ $item->maloaisanpham }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa loại sản phẩm</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/sualoaisanpham" name="update"  method="POST">
                              @csrf
                              <div class="mb-3 mt-3">
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->maloaisanpham }}">
                                <label for="name" class="form-label">Tên loại sản phẩm:</label>
                                <input type="text" class="form-control" id="name{{ $item->maloaisanpham }}" name="name" value="{{ $item->tenloaisanpham }}" required maxlength="100">
                                <p id="errorname{{ $item->maloaisanpham }}" class="message">Tên không được để trống</p>
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
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->maloaisanpham }}"><i class="bi bi-x"></i>Đóng</button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->maloaisanpham }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/anloaisanpham">
                              <div>Bạn có chắc chắc ngừng bán loại sản phẩm: {{ $item->tenloaisanpham }}</div>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->maloaisanpham }}">
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
                @endif
            @endforeach
          </tbody>
        </table>
      </div>
       @endsection
    </body>
</html>

