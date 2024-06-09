<head>
    <style>
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
      <div class="col-5">
        <form action="xulythanhtoan" method="POST">
          @csrf
          <input type="hidden" name="discount" id="discount" value="{{ $discount }}">
          <input type="hidden" name="total" id="total" value="{{ ($total * (100 - $discount)/100) + 30000 }}">
            <h5>Thông tin người nhận</h5>
                <div class="mb-3 mt-3">
                  <input type="text" class="form-control" id="name" placeholder="Tên người nhận" name="name" required>
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="phone" placeholder="Số điện thoại" name="phone" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="address" placeholder="Địa chỉ" name="address" required>
                  </div>
                  <div class="mb-3">
                    <textarea type="text" class="form-control" id="describe" placeholder="Ghi chú cho các món ăn" name="describe"></textarea>
                  </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="radio1" name="payment" value="Thanh toán trực tiếp" checked>
                <label class="form-check-label" for="radio1">Thanh toán trực tiếp</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" id="radio2" name="payment" value="Thanh toán trực tuyến">
                <label class="form-check-label" for="radio2">Thanh toán trực tuyến</label>
              </div>
              <div class="pay_offline">
                <button type="submit" name="redirect" class="btn btn-danger">Thanh toán</button>
              </div>
        </form>
      </div>
      <div class="col-5">
        <h5>Đơn hàng của bạn</h5>
            <div class="table-responsive" >
                <table class="table table-bordered" >
                  <thead align="center">
                    <tr >
                      <th>Sản phẩm</th>
                      <th>Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($listProduct as $item)
                    <tr>
                      <td>{{ $item->tensanpham }} x {{ $item->soluong }}</td>
                      <td><span class="money">{{ $listPrice[$item->masanpham]*$item->soluong }}</span>&#8363;</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>Phí ship</td>
                        <td><span class="money">30000</span>&#8363;</td>
                    </tr>
                    @if ( $discount != 0)
                    <tr>
                      <td>Giảm giá</td>
                      <td>{{ $discount }}%</td>
                    </tr>
                    <tr>
                      <td>Tổng tiền</td>
                      <td><span class="money">{{ ($total[0] * (100 - $discount)/100) + 30000 }}</span>&#8363;</td>
                    </tr>
                    @else
                    <tr>
                      <td>Tổng tiền</td>
                      <td><span class="money">{{ $total+30000 }}</span>&#8363;</td>
                    </tr>  
                    @endif
                  </tbody>
                </table>
              </div>
              <div class="discount">
                <form method="GET" action="/thanhtoangiamgia">
                  <label>Mã giảm giá:</label>
                  <input type="text" name="code" id="code">
                  <input type="submit" value="Nhập mã">
                </form>
              </div>
      </div>
      <div class="col-1"></div>
    </div>
    @endsection
</html>
