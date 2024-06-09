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
    </head>
    <body>
       @extends('layouts.admin')
       @section('head')
       Danh sách bàn ăn
       @endsection
       @section('content')
       <!-- Button them moi -->
        <div class="new"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới</button></div>
        <!-- Them moi -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới bàn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="/admin/themban" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Mã bàn:</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Mô tả:</label>
                      <textarea type="text" class="form-control" id="describe" name="describe" required></textarea>
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
              <th>Mô tả</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listTable as $item)
            <tr>
                <td>{{ $item->maban }}</td>
                <td>{{ $item->mota }}</td>
                <td>{{ $item->trangthai }}</td>
                @if($item->trangthai == "Đang bị khóa")
                <td>
                  <!-- Button sua -->
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#id{{ $item->maban }}"><i class="bi bi-pencil"></i>Sửa</button>
                  <!-- Sua -->
                  <div class="modal fade" id="id{{ $item->maban }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin bàn</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/suaban" method="POST">
                              @csrf
                              <div class="mb-3 mt-3">
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->maban }}">
                                <label for="name" class="form-label">Mã bàn:</label>
                                <input type="text" class="form-control" id="name2" name="name" value="{{ $item->maban }}">
                              </div>
                              <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Mô tả:</label>
                                <textarea type="text" class="form-control" id="describe" name="describe" required>{{ $item->mota }}</textarea>
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
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->maban }}"><i class="bi bi-check2"></i>Mở khóa</button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->maban }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/hienban">
                              <div>Bạn có chắc chắc mở bàn: {{ $item->maban }}</div>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->maban }}">
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
                @if($item->trangthai == 'Trống')
                <td>
                  <!-- Button sua -->
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#id{{ $item->maban }}"><i class="bi bi-pencil"></i>Sửa</button>
                  <!-- Sua -->
                  <div class="modal fade" id="id{{ $item->maban }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin bàn</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/suaban" method="POST">
                              @csrf
                              <div class="mb-3 mt-3">
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->maban }}">
                                <label for="name" class="form-label">Mã bàn:</label>
                                <input type="text" class="form-control" id="name2" name="name" value="{{ $item->maban }}">
                              </div>
                              <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Mô tả:</label>
                                <textarea type="text" class="form-control" id="describe" name="describe" required>{{ $item->mota }}</textarea>
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
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->maban }}"><i class="bi bi-x"></i>Khóa</button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->maban }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/anban">
                              <div>Bạn có chắc chắc khóa bàn: {{ $item->maban }}</div>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->maban }}">
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
                @if($item->trangthai == 'Đang sử dụng')
                <td></td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
       @endsection
    </body>
</html>

