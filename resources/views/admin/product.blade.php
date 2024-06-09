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
            .here{
              color: red;
              font-weight: bold;
            }
            .ingredients{
              color: black;
            }
       </style>
    </head>
    <body>
       @extends('layouts.admin')
       @section('head')
       Danh sách sản phẩm
       @endsection
       @section('content')
       <!-- Button them moi -->
        <div class="new">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#themmoi">Thêm mới</button>
          {{-- <form action="/admin/timkiemsanpham" class="search">
              <input type="text" class="form-control" id="name" name="name" placeholder="Tên sản phẩm...">
              <button type="submit"><i class="bi bi-search"></i></button>
          </form> --}}
        </div>
        <!-- Them moi -->
        <div class="modal fade" id="themmoi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="/admin/themsanpham" method="POST" class="needs-validation" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                      <label for="name" class="form-label">Tên sản phẩm:</label>
                      <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Hình ảnh:</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Loại sản phẩm:</label>
                        <select name="idCategory" id="idCategory">
                            @foreach ($listCategory as $item)
                            <option value="{{  $item->maloaisanpham }}">{{  $item->tenloaisanpham }}</option>
                            @endforeach
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
              <th>Tên sản phẩm</th>
              <th>Hình ảnh</th>
              <th>Nguyên liệu</th>
              <th>Đơn giá</th>
              <th>Loại sản phẩm</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listProduct as $item)
            <tr>
                <td>{{ $item->masanpham }}</td>
                <td>{{ $item->tensanpham }}</td>
                <td><img src="../image/{{ $item->hinhanh }}" width="150px"></td>
                <td>
                  @if(!$listIngredients[$item->masanpham])
                  <p class="text-danger">Click <a href="/admin/nguyenlieusanpham?id={{ $item->masanpham }}" class="here">Tại đây</a> để thêm nguyên liệu cho sản phẩm</p>
                  @endif
                  @foreach ($listIngredients[$item->masanpham] as $n)
                    <a href="/admin/nguyenlieusanpham?id={{ $item->masanpham }}" class="ingredients">{{ $n->tennguyenlieu }} {{ $n->trongluong_thetich*$n->soluong }} {{ $n->donvi }}<br></a>
                  @endforeach
                </td>
                <td>
                  <span class="money">{{ $listPrice[$item->masanpham] }}</span>&#8363;
                </td>
                <td>{{ $item->tenloaisanpham }}</td>
                @if ($item->trangthai == 1)
                <td>Đang bán</td>
                <td>
                  <!-- Button sua -->
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#id{{ $item->masanpham }}"><i class="bi bi-pencil"></i></button>
                  <!-- Sua -->
                  <div class="modal fade" id="id{{ $item->masanpham }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa sản phẩm</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/suasanpham" method="POST" class="needs-validation" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->masanpham }}">
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Tên sản phẩm:</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{ $item->tensanpham }}" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Hình ảnh:<img src="../image/{{ $item->hinhanh }}" width="150px"></label>
                                    <input type="file" class="form-control" id="image" name="image" value="{{  $item->hinhanh }}" >
                                  </div>
                                  <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Loại sản phẩm:</label>
                                    <select name="idCategory" id="idCategory">
                                        @foreach ($listCategory as $a)
                                            @if ($a->maloaisanpham == $item->maloaisanpham )
                                                <option value="{{  $a->maloaisanpham }}" selected>{{  $a->tenloaisanpham }}</option>
                                            @else
                                                <option value="{{  $a->maloaisanpham }}">{{  $a->tenloaisanpham }}</option>
                                            @endif
                                        @endforeach
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
                  <!-- Sua -->
                  <!-- Button Xoa -->
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->masanpham }}"><i class="bi bi-x"></i></button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->masanpham }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/ansanpham">
                              <div>Bạn có chắc chắc ngừng bán sản phẩm: {{ $item->tensanpham }}</div>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->masanpham }}">
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
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#id{{ $item->masanpham }}"><i class="bi bi-pencil"></i></button>
                  <!-- Sua -->
                  <div class="modal fade" id="id{{ $item->masanpham }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Sửa sản phẩm</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/suasanpham" method="POST" class="needs-validation" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->masanpham }}">
                                <div class="mb-3 mt-3">
                                  <label for="name" class="form-label">Tên sản phẩm:</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{ $item->tensanpham }}" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Hình ảnh:<img src="../image/{{ $item->hinhanh }}" width="150px"></label>
                                    <input type="file" class="form-control" id="image" name="image" value="{{  $item->hinhanh }}" >
                                  </div>
                                  <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Loại sản phẩm:</label>
                                    <select name="idCategory" id="idCategory">
                                        @foreach ($listCategory as $a)
                                            @if ($a->maloaisanpham == $item->maloaisanpham )
                                                <option value="{{  $a->maloaisanpham }}" selected>{{  $a->tenloaisanpham }}</option>
                                            @else
                                                <option value="{{  $a->maloaisanpham }}">{{  $a->tenloaisanpham }}</option>
                                            @endif
                                        @endforeach
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
                  <!-- Sua -->
                  <!-- Button Xoa -->
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xoa{{ $item->masanpham }}"><i class="bi bi-check2"></i></button>
                  <!-- Xoa -->
                  <div class="modal fade" id="xoa{{ $item->masanpham }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/hiensanpham">
                              <div>Bạn có chắc chắc mở sản phẩm: {{ $item->tensanpham }}</div>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $item->masanpham }}">
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

