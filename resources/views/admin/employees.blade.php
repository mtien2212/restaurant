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
       Danh sách nhân viên
       @endsection
       @section('content')
       <!-- Button them moi -->
        <div class="new"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#themmoi">Thêm mới</button></div>
        <!-- Them moi -->
        <div class="modal fade" id="themmoi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="/admin/themnhanvien" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Tên nhân viên:</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tuổi:</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Giới tính:</label>
                        <select name="gentle" id="gentle">
                          <option>Nam</option>
                          <option>Nữ</option>
                        </select>
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Quê quán:</label>
                        <input type="text" class="form-control" id="home" name="home" required>
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Chức vụ:</label>
                        <select name="role" id="role">
                          <option>Duyệt đơn</option>
                          <option>Đầu bếp</option>
                          <option>Phục vụ</option>
                          <option>Vận chuyển</option>
                        </select>
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
            <tr align="center" valign="top">
              <th>ID</th>
              <th>Tên nhân viên</th>
              <th>Tuổi</th>
              <th>Giới tính</th>
              <th>SDT</th>
              <th>Email</th>
              <th>Quê quán</th>
              <th>Địa chỉ</th>
              <th>Chức vụ</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listEmployee as $item)
            <tr>
                <td>{{ $item->manhanvien}}</td>
                <td>{{ $item->tennhanvien }}</td>
                <td>{{ $item->tuoi }}</td>
                <td>{{ $item->gioitinh }}</td>
                <td>{{ $item->sdt }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->quequan }}</td>
                <td>{{ $item->diachi }}</td>
                <td>{{ $item->chucvu }}</td>
                @if($item->trangthai == 1)
                <td>Đang hoạt động</td>
                <td>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#sua{{ $item->manhanvien }}"><i class="bi bi-pencil"></i></button>
                  <!-- Them moi -->
                  <div class="modal fade" id="sua{{ $item->manhanvien }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa nhân viên</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/suanhanvien" method="POST">
                              @csrf
                              <input type="hidden" name="id" id="id" value="{{ $item->manhanvien }}">
                              <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Tên nhân viên:</label>
                                <input type="text" class="form-control" id="name" name="name" required value="{{ $item->tennhanvien }}">
                              </div>
                              <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Tuổi:</label>
                                  <input type="number" class="form-control" id="age" name="age" required value="{{ $item->tuoi }}">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Giới tính:</label>
                                  <select name="gentle" id="gentle">
                                    @if($item->gioitinh == 'Nam')
                                    <option selected>Nam</option>
                                    <option>Nữ</option>
                                    @else
                                    <option>Nam</option>
                                    <option selected>Nữ</option>
                                    @endif
                                  </select>
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Số điện thoại:</label>
                                  <input type="text" class="form-control" id="phone" name="phone" required value="{{ $item->sdt }}">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Email:</label>
                                  <input type="email" class="form-control" id="email" name="email" required value="{{ $item->email }}">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Quê quán:</label>
                                  <input type="text" class="form-control" id="home" name="home" required value="{{ $item->quequan }}">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Địa chỉ:</label>
                                  <input type="text" class="form-control" id="address" name="address" required value="{{ $item->diachi }}">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Chức vụ:</label>
                                  <select name="role" id="role">
                                    @if($item->chucvu == 'Duyệt đơn')
                                    <option selected>Duyệt đơn</option>
                                    <option>Đầu bếp</option>
                                    <option>Phục vụ</option>
                                    <option>Vận chuyển</option>
                                    @endif
                                    @if($item->chucvu == 'Đầu bếp')
                                    <option >Duyệt đơn</option>
                                    <option selected>Đầu bếp</option>
                                    <option>Phục vụ</option>
                                    <option>Vận chuyển</option>
                                    @endif
                                    @if($item->chucvu == 'Phục vụ')
                                    <option>Duyệt đơn</option>
                                    <option>Đầu bếp</option>
                                    <option selected>Phục vụ</option>
                                    <option>Vận chuyển</option>
                                    @endif
                                    @if($item->chucvu == 'Vận chuyển')
                                    <option >Duyệt đơn</option>
                                    <option>Đầu bếp</option>
                                    <option>Phục vụ</option>
                                    <option selected>Vận chuyển</option>
                                    @endif
                                  </select>
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
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->manhanvien }}"><i class="bi bi-x"></i></button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->manhanvien }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/xoanhanvien">
                              <div>Bạn có chắc chắc vô hiệu hóa: {{ $item->tennhanvien }}</div>
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
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#sua{{ $item->manhanvien }}"><i class="bi bi-pencil"></i></button>
                  <!-- Them moi -->
                  <div class="modal fade" id="sua{{ $item->manhanvien }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa nhân viên</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/suanhanvien" method="POST">
                              @csrf
                              <input type="hidden" name="id" id="id" value="{{ $item->manhanvien }}">
                              <div class="mb-3 mt-3">
                                <label for="name" class="form-label">Tên nhân viên:</label>
                                <input type="text" class="form-control" id="name" name="name" required value="{{ $item->tennhanvien }}">
                              </div>
                              <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Tuổi:</label>
                                  <input type="number" class="form-control" id="age" name="age" required value="{{ $item->tuoi }}">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Giới tính:</label>
                                  <select name="gentle" id="gentle">
                                    @if($item->gioitinh == 'Nam')
                                    <option selected>Nam</option>
                                    <option>Nữ</option>
                                    @else
                                    <option>Nam</option>
                                    <option selected>Nữ</option>
                                    @endif
                                  </select>
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Số điện thoại:</label>
                                  <input type="text" class="form-control" id="phone" name="phone" required value="{{ $item->sdt }}">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Email:</label>
                                  <input type="email" class="form-control" id="email" name="email" required value="{{ $item->email }}">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Quê quán:</label>
                                  <input type="text" class="form-control" id="home" name="home" required value="{{ $item->quequan }}">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Địa chỉ:</label>
                                  <input type="text" class="form-control" id="address" name="address" required value="{{ $item->diachi }}">
                                </div>
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Chức vụ:</label>
                                  <select name="role" id="role">
                                    @if($item->chucvu == 'Duyệt đơn')
                                    <option selected>Duyệt đơn</option>
                                    <option>Đầu bếp</option>
                                    <option>Phục vụ</option>
                                    <option>Vận chuyển</option>
                                    @endif
                                    @if($item->chucvu == 'Đầu bếp')
                                    <option >Duyệt đơn</option>
                                    <option selected>Đầu bếp</option>
                                    <option>Phục vụ</option>
                                    <option>Vận chuyển</option>
                                    @endif
                                    @if($item->chucvu == 'Phục vụ')
                                    <option>Duyệt đơn</option>
                                    <option>Đầu bếp</option>
                                    <option selected>Phục vụ</option>
                                    <option>Vận chuyển</option>
                                    @endif
                                    @if($item->chucvu == 'Vận chuyển')
                                    <option >Duyệt đơn</option>
                                    <option>Đầu bếp</option>
                                    <option>Phục vụ</option>
                                    <option selected>Vận chuyển</option>
                                    @endif
                                  </select>
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
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->manhanvien }}"><i class="bi bi-check2"></i></button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->manhanvien }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/kichhoatnhanvien">
                              <div>Bạn có chắc chắc kích hoạt: {{ $item->tennhanvien }}</div>
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

