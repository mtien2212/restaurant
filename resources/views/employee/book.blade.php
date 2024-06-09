<head>
    <style>
    </style>
</head>
<html>
    @extends('layouts.employee')
    @section('head')
    Danh sách đặt bàn
    @endsection
    @section('content')
        <div class="table-responsive" >
          <table class="table table-bordered" >
            <thead align="center">
              <tr >
                <th>Mã bàn</th>
                <th>Khách hàng</th>
                <th>Thời gian</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($listBook as $item)
              <tr>
                <td>{{ $item->maban }}</td>
                <td>{{ $item->tenkhachhang }}</td>
                <td>{{ $item->ngaydat }} {{ $item->giodat }}</td>
                <td>
                        <!-- Button them moi -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#{{ $item->maban }}">Hủy đặt</button>
                        <!-- Them moi -->
                        <div class="modal fade" id="{{ $item->maban }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn hủy đặt bàn khách {{ $item->tenkhachhang }}  vào {{ $item->ngaydat }} {{ $item->giodat }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <a href="/nhanvien/huydat?id={{ $item->maban }}&date={{ $item->ngaydat }}"><button type="button" class="btn btn-primary">Hủy</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Them moi -->
                </td> 
              </tr>
              @endforeach 
            </tbody>
          </table>
        </div>
    </div>
    @endsection
</html>
