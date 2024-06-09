<html>
    <head>
        <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            body {
                background-image: url("image/bg.png");
            }
            .form{
                display: block;
                margin-top: 18%;
                background-color: white;
                padding: 20px;
                border-radius: 5px;
                border: solid 2px;
                border-color: red;
            }
            .submit{
                display: flex;
                justify-content: center;
            }
            h2{
                margin: 0px;
                color: red;
                font-weight: bold;
                text-align: center;
            }
            p{
                color: white;
                text-align: center;
            }
            .register{
                text-decoration: none;
                font-weight: bold;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <form action="/xulydangky" class="form" method="POST">
                    @csrf
                    <h2>Đăng ký</h2>
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Họ tên:</label>
                        <input type="name" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="age" class="form-label">Tuổi:</label>
                        <input type="number" class="form-control" id="age" name="age">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="gentle" class="form-label">Giới tính:</label>
                        <select id="gentle" name="gentle">
                            <option>Nam</option>
                            <option>Nữ</option>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="number" class="form-label">Số điện thoại:</label>
                        <input type="number" class="form-control" id="number" name="number">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="address" class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="account" class="form-label">Tài khoản:</label>
                        <input type="text" class="form-control" id="account" name="account">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="submit"><button type="submit" class="btn btn-danger">Đăng ký</button></div>
                </form>
                <p>Bạn đã có tài khoản? <a href="/dangnhap" class="register">Đăng nhập</a></p>
            </div>
            <div class="col-4"></div>
        </div>
    </body>
</html>