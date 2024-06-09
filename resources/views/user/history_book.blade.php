<head>
    <style>
      .pay{
        background-color: red;
        color: white;
        border-radius: 5px;
        padding: 5px;
      }
      .sentence{
        color: red;
        text-align: center;
      }
    </style>
</head>
<html>
    @extends('layouts.user')
    @section('banner')
        <img src="image/banner_user.png" width="100%">
    @endsection
    @section('content')
    <p></p>
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10">
        <h5>Lịch sử đặt bàn</h5>
        <div class="table-responsive" >
            <table class="table table-bordered" >
              <thead align="center">
                <tr >
                  <th>Mã bàn</th>
                  <th>Thời gian</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($listBook as $item)
                <tr>
                  <td>{{ $item->maban }}</td>
                  <td>{{ $item->ngaydat }} {{ $item->giodat }}</td>
                </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
      </div>
      </div>
      <div class="col-1"></div>
    </div>
    @endsection
</html>
