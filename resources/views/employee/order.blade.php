<head>
    <style>
    </style>
</head>
<html>
    @extends('layouts.employee')
    @section('head')
    Danh sách bàn ăn
    @endsection
    @section('content')
        <div class="table-responsive" >
          <table class="table table-bordered" >
            <thead align="center">
              <tr >
                <th>Mã bàn</th>
                <th>Mô tả</th>
                <th>Đặt bàn</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($listTable as $item)
              <tr>
                <td>{{ $item->maban }}</td>
                <td>{{ $item->mota }}</td>
                @if (!$status[$item->maban])
                    <td></td>  
                @else
                    <td>Bàn đã được đặt bởi {{ $status[$item->maban]->tenkhachhang }} vào {{ $status[$item->maban]->ngaydat }}</td>  
                @endif
                <td>{{ $item->trangthai }}</td>
                <td>
                    @if ($item->trangthai == "Đang sử dụng")
                    <!-- Button them moi -->
                    <a href="/nhanvien/themmon?id=3&idb={{ $item->maban }}"><button type="button" class="btn btn-primary">Chi tiết</button></a>
                    <!-- Them moi -->
                    @else
                        <!-- Button them moi -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#{{ $item->maban }}">Mở bàn</button>
                        <!-- Them moi -->
                        <div class="modal fade" id="{{ $item->maban }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn mở bàn {{ $item->maban }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <a href="/nhanvien/moban?iddh=3&idb={{ $item->maban }}"><button type="button" class="btn btn-primary">Mở bàn</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Them moi -->
                        
                    @endif
                </td> 
              </tr>
              @endforeach 
            </tbody>
          </table>
        </div>
    </div>
    @endsection
</html>
