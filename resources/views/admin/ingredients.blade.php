<html lang="vie">
    <head>
       <style>
            .new{
                display: flex;
                justify-content: space-between;
                margin: 10px;
            }
            .search{
              display: flex;
              justify-content: flex-start;
            }
       </style>
    </head>
    <body>
       @extends('layouts.admin')
       @section('head')
       Danh sách nguyên liệu
       @endsection
       @section('content')
       <!-- Button them moi -->
        <div class="new">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#themmoi">Thêm mới</button>
        </div>
        <!-- Them moi -->
        <div class="modal fade" id="themmoi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới nguyên liệu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="/admin/themnguyenlieu" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Tên nguyên liệu:</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                      <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Trọng lượng/ Thể tích:</label>
                        <input type="number" class="form-control" id="weight" name="weight" required>
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Đơn vị:</label>
                        <input type="text" class="form-control" id="unit" name="unit" required>
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Đơn giá:</label>
                        <input type="text" class="form-control" id="price" name="price" required>
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
              <th>Tên nguyên liệu</th>
              <th>Trọng lượng/ Thể tích</th>
              <th>Đơn vị</th>
              <th>Đơn giá</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listIngredients as $item)
            <tr>
                <td>{{ $item->manguyenlieu }}</td>
                <td>{{ $item->tennguyenlieu}}</td>
                <td>{{ $item->trongluong_thetich }}</td>
                <td>{{ $item->donvi }}</td>
                <td ><span class="money">{{ $item->dongia }}</span>&#8363;</td>
                </td>
                @if ($item->trangthai == 1)
                <td>Đang bán</td>
                <td>
                  <!-- Button sua -->
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#id{{ $item->manguyenlieu }}"><i class="bi bi-pencil"></i></button>
                  <!-- Sua -->
                  <div class="modal fade" id="id{{ $item->manguyenlieu }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa nguyên liệu</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/suanguyenlieu" method="POST" class="needs-validation" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->manguyenlieu }}">
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Tên nguyên liệu:</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{ $item->tennguyenlieu }}" required>
                                </div>
                                  <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Trọng lượng/ Thể tích:</label>
                                    <input type="number" class="form-control" id="weight" name="weight" value="{{ $item->trongluong_thetich }}" required>
                                  </div>
                                  <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Đơn vị:</label>
                                    <input type="text" class="form-control" id="unit" name="unit" value="{{ $item->donvi }}" required>
                                  </div>
                                  <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Đơn giá:</label>
                                    <input type="text" class="form-control" id="price" name="price" value="{{ $item->dongia }}" required>
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
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->manguyenlieu }}"><i class="bi bi-x"></i></button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->manguyenlieu }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/annguyenlieu">
                              <div>Bạn có chắc chắc ngừng bán nguyên liệu: {{ $item->tennguyenlieu }}</div>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->manguyenlieu }}">
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
                @else
                <td>Ngừng bán</td>
                <td>
                  <!-- Button sua -->
                   <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#id{{ $item->manguyenlieu }}"><i class="bi bi-pencil"></i></button>
                  <!-- Sua -->
                  <div class="modal fade" id="id{{ $item->manguyenlieu }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa nguyên liệu</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/suanguyenlieu" method="POST" class="needs-validation" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->manguyenlieu }}">
                                  <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Tên nguyên liệu:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $item->tennguyenlieu }}" required>
                                  </div>
                                    <div class="mb-3 mt-3">
                                      <label for="name" class="form-label">Trọng lượng/ Thể tích:</label>
                                      <input type="number" class="form-control" id="weight" name="weight" value="{{ $item->trongluong_thetich }}" required>
                                    </div>
                                    <div class="mb-3 mt-3">
                                      <label for="name" class="form-label">Đơn vị:</label>
                                      <input type="text" class="form-control" id="unit" name="unit" value="{{ $item->donvi }}" required>
                                    </div>
                                    <div class="mb-3 mt-3">
                                      <label for="name" class="form-label">Đơn giá:</label>
                                      <input type="text" class="form-control" id="price" name="price" value="{{ $item->dongia }}" required>
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
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->manguyenlieu }}"><i class="bi bi-check2"></i></button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->manguyenlieu }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/hiennguyenlieu">
                              <div>Bạn có chắc chắc mở nguyên liệu: {{ $item->tennguyenlieu }}</div>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->manguyenlieu }}">
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

