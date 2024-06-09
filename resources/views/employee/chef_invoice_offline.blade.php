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
       @extends('layouts.employee')
       @section('head')
       Danh sách món ăn tại quán
       @endsection
       @section('content')
       <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr align="center" valign="top">
              <th>ID</th>
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
              <th>Nguyên liệu</th>
              <th>Bàn</th>
              <th>Thao tác</th>
          </thead>
          <tbody>
            @foreach ($listProduct as $item)
            <tr>
                <td>{{ $item->masanpham }}</td>
                <td>{{ $item->tensanpham }}</td>
                <td>{{ $item->soluong }}</td>
                <td>
                  @foreach ($listIngredients[$item->masanpham] as $n)
                    {{ $n->tennguyenlieu }} {{ $n->trongluong_thetich*$n->soluong }}{{ $n->donvi }} 
                  @endforeach
                </td>
                <td>{{ $item->maban }}</td>
                <td><a href="/nhanvien/naumon?idsp={{ $item->masanpham }}&iddh={{ $item->madonhang }}"><button class="btn btn-success"><i class="bi bi-check"></i></button></a></td>
              </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
       @endsection
  
    </body>
</html>

