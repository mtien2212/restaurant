<head>
    <style>
    </style>
</head>
<html>
    @extends('layouts.user')
    @section('banner')
        <img src="image/banner.png" width="100%">
    @endsection
    @section('content')
    <p></p>
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10">
        <form action="#" method="GET">
          <label>Ngày đặt bàn:</label>
          <input type="date" name="date" value="{{ $date }}" min="{{ $tomorow }}">
          <input type="submit" value="Chọn">
        </form>
      </div>
      <div class="col-1"></div>
    </div>
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10">
        <div class="table-responsive" >
          <table class="table table-bordered" >
            <thead align="center">
              <tr >
                <th>Mã bàn</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              @for ($i = 0; $i < $count; $i++)
              <tr>
                <td>{{ $listTable[$i]->maban }}</td>
                <td>{{ $listTable[$i]->mota }}</td>
                @if ($s[$i] == 0)
                    <td>Trống</td>  
                    <td><!-- Button them moi -->
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $listTable[$i]->maban }}">Đặt bàn</button>
                      <!-- Them moi -->
                      <div class="modal fade" id="{{ $listTable[$i]->maban }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Đặt bàn</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/dat" method="POST" >
                                  @csrf
                                  <div class="mb-3 mt-3">
                                    <p>Ngày đặt: {{ $date }}</p>
                                    <p>Bàn: {{ $listTable[$i]->maban }}</p>
                                    <input type="hidden" name="table" value="{{ $listTable[$i]->maban }}">
                                    <input type="hidden" name="date" value="{{ $date }}">
                                  </div>
                                  <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Thời gian:</label>
                                    <input type="time" class="form-control" id="time" name="time" required>
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
                      <!-- Them moi --></td>
                @else
                    <td>Đã đặt</td>  
                    <td></td>
                @endif
              </tr>
              @endfor 
            </tbody>
          </table>
        </div>
      </div>
      </div>
      <div class="col-1"></div>
    </div>
    @endsection
</html>
