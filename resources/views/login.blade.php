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
                <form action="/xulydangnhap" class="form" method="POST">
                    @csrf
                    <h2>Đăng nhập</h2>
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="name" placeholder="Vui lòng nhập tên đăng nhập" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" placeholder="Vui lòng nhập tên đăng nhập" name="password">
                    </div>
                    <div class="submit"><button type="submit" class="btn btn-danger">Đăng nhập</button></div>
                </form>
                <p>Bạn chưa có tài khoản? <a href="/dangky" class="register">Đăng ký</a></p>
            </div>
            <div class="col-4"></div>
        </div>
    </body>
</html>