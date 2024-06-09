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
        <img src="image/cart.png" width="100%">
    @endsection
    @section('content')
    <p></p>
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10">
        @if(count($listProduct) == 0)
        <h2 class="sentence">Giỏ hàng trống click <a href="/">"Tại đây"</a> để quay trở lại</h2>
        @else 
        <div class="table-responsive" >
          <table class="table table-bordered" >
            <thead align="center">
              <tr >
                <th colspan="2">Sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th width="150px"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($listProduct as $item)
              <tr>
                <td width = "100px"><img src="image/{{ $item->hinhanh }}" width="100%"></td>
                <td>{{ $item->tensanpham }}</td>
                <td><span class="money">{{ $listPrice[$item->masanpham] }}</span>&#8363;</td>
                <td align="center"><a href="/thaydoisoluonggiohang?quality={{ $item->soluong - 1 }}&idkh={{ session('user') }}&idsp={{ $item->masanpham }}"><i class="bi bi-dash-circle"></i> </a> {{ $item->soluong }} <a href="/thaydoisoluonggiohang?quality={{ $item->soluong + 1 }}&idkh={{ session('user') }}&idsp={{ $item->masanpham }}"> <i class="bi bi-plus-circle"></i></a></td>
                <td><span class="money">{{ $listPrice[$item->masanpham]*$item->soluong }}</span>&#8363;</td>
                <td><a href="/xoasanphamgiohang?idkh={{ session('user') }}&idsp={{ $item->masanpham }}"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></a></td>
              </tr>
              @endforeach
              <tr>
                <td colspan="4">Tổng tiền</td>
                <td><span class="money">{{ $total }}</span>&#8363;</td>
                <td><a href="/thanhtoan"><button class="pay">Thanh toán</button></a></td>
              </tr>
            </tbody>
          </table>
        </div>
        @endif
        
      </div>
      <div class="col-1"></div>
    </div>
    @endsection
</html>
