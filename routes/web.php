<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\IngredientsController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dangnhap', function () {
    return view('login');
});
Route::post('/xulydangnhap',  [LoginController::class, 'Login']);
Route::get('/dangxuat',  [LoginController::class, 'Logout']);
//User
Route::get('/dangky', function () {
    return view('user.register');
});
Route::post('/xulydangky',  [UserController::class, 'Register']);
Route::get('/',  [ProductController::class, 'BestSellerProduct']);
Route::get('/thucdonlau',  [CategoryController::class, 'GetProductByCategory']);
Route::get('/sanpham',  [ProductController::class, 'DetailProduct']);
Route::get('/tintuc',  [NewsController::class, 'News']);
Route::get('/datban',  [TableController::class, 'Book']);
Route::middleware('user')->post('/dat',  [TableController::class, 'BookTable']);
Route::get('/gioithieu', function () {
    return view('user.introduce');
});
Route::middleware('user')->get('/giohang',  [CartController::class, 'CustomerCart']);
Route::middleware('user')->get('/themvaogio', [CartController::class, 'AddProductCart']);
Route::middleware('user')->get('/xoasanphamgiohang', [CartController::class, 'DeleteProductCart']);
Route::middleware('user')->get('/thaydoisoluonggiohang', [CartController::class, 'UpdateProductCart']);
Route::middleware('user')->get('/thanhtoan',  [CartController::class, 'CustomerPay']);
Route::middleware('user')->get('/thanhtoangiamgia',  [CartController::class, 'CustomerPayWithDiscount']);
Route::middleware('user')->post('/xulythanhtoan',  [CartController::class, 'Payment']);
Route::get('/xulythanhtoanvnpay',  [CartController::class, 'PaymentOnline']);
Route::middleware('user')->get('/trangcanhan',  [UserController::class, 'Information']);
Route::middleware('user')->get('/lichsumuahang',  [UserController::class, 'HistoryInvoice']);
Route::middleware('user')->get('/lichsudatban',  [UserController::class, 'HistoryBook']);

//admin
Route::middleware('admin')->prefix('admin')->group(function(){
    //Loại sản phẩm
    Route::get('/loaisanpham',  [CategoryController::class, 'Categorys']);
    Route::post('/themloaisanpham',  [CategoryController::class, 'AddCategory']);
    Route::post('/sualoaisanpham',  [CategoryController::class, 'UpdateCategory']);
    Route::get('/anloaisanpham',  [CategoryController::class, 'DisableCategory']);
    Route::get('/hienloaisanpham',  [CategoryController::class, 'ActiveCategory']);

    //Sản phẩm
    Route::get('/sanpham',  [ProductController::class, 'AllProduct']);
    Route::get('/timkiemsanpham',  [ProductController::class, 'SearchProduct']);
    Route::post('/themsanpham',  [ProductController::class, 'AddProduct']);
    Route::post('/suasanpham',  [ProductController::class, 'UpdateProduct']);
    Route::get('/ansanpham',  [ProductController::class, 'DisableProduct']);
    Route::get('/hiensanpham',  [ProductController::class, 'ActiveProduct']);

    //Nguyên liệu
    Route::get('/nguyenlieu',  [IngredientsController::class, 'AllIngredients']);
    Route::get('/timkiemnguyenlieu',  [IngredientsController::class, 'SearchIngredients']);
    Route::post('/themnguyenlieu',  [IngredientsController::class, 'AddIngredients']);
    Route::post('/suanguyenlieu',  [IngredientsController::class, 'UpdateIngredients']);
    Route::get('/annguyenlieu',  [IngredientsController::class, 'DisableIngredients']);
    Route::get('/hiennguyenlieu',  [IngredientsController::class, 'ActiveIngredients']);
    Route::get('/nguyenlieusanpham',  [IngredientsController::class, 'ProductIngredients']);
    Route::get('/themnguyenlieusanpham',  [IngredientsController::class, 'AddProductIngredients']);
    Route::get('/xoanguyenlieusanpham',  [IngredientsController::class, 'DeleteProductIngredients']);
    Route::get('/thaydoisoluongnguyenlieu',  [IngredientsController::class, 'UpdateProductIngredients']);

    //Khách hàng
    Route::get('/khachhang',  [CustomerController::class, 'AllCustomer']);
    Route::get('/xoakhachhang',  [CustomerController::class, 'DisableCustomer']);
    Route::get('/admin/kichhoatkhachhang',  [CustomerController::class, 'ActiveCustomer']);

    //Nhân viên 
    Route::get('/nhanvien',  [EmployeeController::class, 'AllEmployee']);
    Route::post('/themnhanvien',  [EmployeeController::class, 'AddEmployee']);
    Route::post('/suanhanvien',  [EmployeeController::class, 'UpdateEmployee']);
    Route::get('/xoanhanvien',  [EmployeeController::class, 'DisableEmployee']);
    Route::get('/kichhoatnhanvien',  [EmployeeController::class, 'ActiveEmployee']);

    //Ăn tại quán
    Route::get('/antainha',  [InvoiceController::class, 'AllInvoiceOnline']);
    Route::get('/hoadon',  [InvoiceController::class, 'DetailInvoice']);

    //Ăn tại nhà
    Route::get('/antaiquan',  [InvoiceController::class, 'AllInvoiceOffline']);


    //Bàn ăn
    Route::get('/banan',  [TableController::class, 'AllTable']);
    Route::post('/themban',  [TableController::class, 'AddTable']);
    Route::post('/suaban',  [TableController::class, 'UpdateTable']);
    Route::get('/admin/anban',  [TableController::class, 'DisableTable']);
    Route::get('/admin/hienban',  [TableController::class, 'ActiveTable']);

    //Tin tức
    Route::get('/tintuc',  [NewsController::class, 'AllNews']);
    Route::post('/themtintuc',  [NewsController::class, 'AddNews']);
    Route::post('/suatintuc',  [NewsController::class, 'UpdateNews']);
    Route::get('/xoatintuc',  [NewsController::class, 'DeleteNews']);

    //Giảm giá
    Route::get('/giamgia',  [DiscountController::class, 'AllDiscount']);
    Route::post('/themgiamgia',  [DiscountController::class, 'AddDiscount']);
    Route::post('/suagiamgia',  [DiscountController::class, 'UpdateDiscount']);
    Route::get('/xoagiamgia',  [DiscountController::class, 'DeleteDiscount']);

    //Thống kê
    Route::get('/doanhthu',  [StatisticController::class, 'Revenue']);
    Route::get('/tkantainha',  [StatisticController::class, 'StatisticInvoiceOnline']);
});

//Nhân viên
Route::middleware('employee')->prefix('nhanvien')->group(function(){
    //Duyệt đơn
    Route::get('/duyetdon',  [InvoiceController::class, 'CheckInvoiceOnline']);
    Route::get('/duyet',  [InvoiceController::class, 'AcceptInvoiceOnline']);
    Route::get('/huy',  [InvoiceController::class, 'CancelInvoiceOnline']);
    //Đặt bàn
    Route::get('/datban',  [TableController::class, 'CheckBook']);
    Route::get('/huydat',  [TableController::class, 'CancellBook']);
    
    //Đầu bếp
    Route::get('/antainha',  [InvoiceController::class, 'CookInvoiceOnline']);
    Route::get('/nauxong',  [InvoiceController::class, 'CookDoneInvoiceOnline']);
    Route::get('/antaiquan',  [InvoiceController::class, 'CookInvoiceOffline']);
    Route::get('/naumon',  [InvoiceController::class, 'CookDoneInvoiceOffline']);
    //Phục vụ
    Route::get('/order',  [TableController::class, 'BookToday']);
    Route::get('/moban',  [InvoiceController::class, 'NewInvoiceOffline']);
    Route::get('/themmon',  [InvoiceController::class, 'InvoiceOffline']);
    Route::get('/thaydoisoluong',  [InvoiceController::class, 'UpdateQuality']);
    Route::get('/datmon',  [InvoiceController::class, 'AddProductInvoiceOffline']);
    Route::get('/xoamon',  [InvoiceController::class, 'DeleteProductInvoiceOffline']);
    Route::get('/lenmon',  [InvoiceController::class, 'DishupInvoiceOffline']);
    Route::get('/lenmonxong',  [InvoiceController::class, 'DishupDoneInvoiceOffline']);
    Route::get('/thanhtoan',  [InvoiceController::class, 'Payment']);
    //Vận chuyển
    Route::get('/shipdon',  [InvoiceController::class, 'ShipInvoiceOnline']);
    Route::get('/hoanthanh',  [InvoiceController::class, 'ShipDoneInvoiceOnline']);
    Route::get('/hoadon',  [InvoiceController::class, 'DetailShip']);
});