<html>
    <head>
        <link href="../bootstrap-5.0.2-dist/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            body{
                padding: 20px;
                padding-left: 100px; 
            }
            .invoice{
                width: 500px;
                border: solid 1px;
            }
            .head{
                margin: 0;
                padding: 0;
                width: 100%;
                display: flex;
                justify-content: center;
            }
            h3{
                text-align: center;
            }
            a{
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="invoice">
            <div class="head">
                <img src="../image/logo.png" width="100px">
                <div class="inf">
                    <h3>Nhà hàng lẩu EATHOUSE</h3>
                    <p>Số 19 ngõ 20 Nguyễn Chánh, Cầu Giấy</p>
                    <p>ĐT: 0898879669</p>
                </div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                  <h3>Phiếu thanh toán</h3>
                      <div class="table-responsive" >
                          <table class="table table-bordered" >
                            <thead align="center">
                              <tr >
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($listProduct as $item)
                              <tr>
                                <td>{{ $stt++ }}</td>
                                <td>{{ $item->tensanpham }}</td>
                                <td>{{ $item->soluong }}</td>
                                <td><span class="money">{{ $listPrice[$item->masanpham] }}</span>&#8363;</td>
                                <td><span class="money">{{ $listPrice[$item->masanpham]*$item->soluong }}</span>&#8363;</td>
                              </tr>
                              @endforeach
                              <tr>
                                <td colspan="4">Tổng tiền</td>
                                <td><span class="money">{{ $total }}</span>&#8363;</td>
                              </tr>  
                            </tbody>
                          </table>
                        </div>
                        
                </div>
                <div class="col-1"></div>
              </div>
        </div>
        <div class="btn"><a href="/nhanvien/shipdon"><button class="btn btn-secondary" id="tl">Trở lại</button></a><button class="btn btn-primary" onClick="xoa()" id="inhd">In hóa đơn</button></div>
    </body>
    <script>
      let x = document.getElementById('inhd');
      let y = document.getElementById('tl');
      function xoa(){
        x.style.display = "none";
        y.style.display = "none";
        window.print();
        history.back();
      }
    </script>
     <script src="../bootstrap-5.0.2-dist/js/bootstrap.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="../js/simple.money.format.js"></script>
        <script> $('.money').simpleMoneyFormat(); </script>
</html>
