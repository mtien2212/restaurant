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
        <form action="/xulydangky" class="form" method="POST">
          @csrf
          <h2>Đăng ký</h2>
          <div class="mb-3 mt-3">
              <label for="name" class="form-label">Họ tên:</label>
              <input type="name" class="form-control" id="name" name="name" value="{{ $inf[0]->tenkhachhang }}">
          </div>
          <div class="mb-3 mt-3">
              <label for="age" class="form-label">Tuổi:</label>
              <input type="number" class="form-control" id="age" name="age" value="{{ $inf[0]->tuoi }}">
          </div>
          <div class="mb-3 mt-3">
              <label for="gentle" class="form-label">Giới tính:</label>
              <select id="gentle" name="gentle">
                @if($inf[0]->gioitinh == "Nam")
                <option selected>Nam</option>
                <option>Nữ</option>
                @endif
                @if($inf[0]->gioitinh == "Nữ")
                <option>Nam</option>
                <option selected>Nữ</option>
                @endif
              </select>
          </div>
          <div class="mb-3 mt-3">
              <label for="number" class="form-label">Số điện thoại:</label>
              <input type="number" class="form-control" id="number" name="number" value="{{ $inf[0]->sdt }}">
          </div>
          <div class="mb-3 mt-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ $inf[0]->email }}">
          </div>
          <div class="mb-3 mt-3">
              <label for="address" class="form-label">Địa chỉ:</label>
              <input type="text" class="form-control" id="address" name="address" value="{{ $inf[0]->diachi }}">
          </div>
          <div class="mb-3 mt-3">
              <label for="account" class="form-label">Tài khoản:</label>
              <input type="text" class="form-control" id="account" name="account" value="{{ $acc[0]->taikhoan }}">
          </div>
          <div class="mb-3">
              <label for="password" class="form-label">Mật khẩu:</label>
              <input type="password" class="form-control" id="password" name="password" value="{{ $acc[0]->matkhau }}">
          </div>
          <div class="submit"><button type="submit" class="btn btn-danger">Cập nhật</button></div>
      </form>
      </div>
      <div class="col-1"></div>
    </div>
    @endsection
</html>
