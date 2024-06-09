<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Ingredients;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function CustomerCart(){
        $price = 0;
        $total = 0;
        $listPrice = null;
        $cart = new Cart();
        $listProduct = $cart->GetAll(session('user'));
        $ingredients = new Ingredients();
        foreach($listProduct as $a){
            $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
            foreach($listIngredients[$a->masanpham] as $b){
                $price += $b->dongia * $b->soluong;
            }
            $listPrice[$a->masanpham] = $price;
            $total += $listPrice[$a->masanpham] * $a->soluong;
            $price = 0; 
        }
        return view('user.cart', ['listProduct' => $listProduct, 'listPrice' => $listPrice, 'total' => $total]);
    }
    public function CustomerPay(){
        $price = 0;
        $total = 0;
        $discount = 0;
        $listPrice = null;
        $cart = new Cart();
        $listProduct = $cart->GetAll(session('user'));
        $ingredients = new Ingredients();
        foreach($listProduct as $a){
            $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
            foreach($listIngredients[$a->masanpham] as $b){
                $price += $b->dongia * $b->soluong;
            }
            $listPrice[$a->masanpham] = $price;
            $total += $listPrice[$a->masanpham] * $a->soluong;
            $price = 0; 
        }
        return view('user.pay', ['listProduct' => $listProduct, 'listPrice' => $listPrice, 'total' => $total, 'discount'=> $discount]);
    }
    public function CustomerPayWithDiscount(){
        $price = 0;
        $total = 0;
        $search = new Discount();
        $discount = $search->SearchDiscount($_REQUEST['code']);
        $start = Carbon::parse($discount[0]->ngaybatdau);
        if(!$discount || $start->isFuture()){
            \Jeybin\Toastr\Toastr::error('Mã giảm giá không tồn tại')->timeOut(3000)
            ->toast();
            return redirect()->back();
        }
        $end = Carbon::parse($discount[0]->ngayketthuc);
        if($end->isPast()){
            \Jeybin\Toastr\Toastr::error('Mã giảm giá hết hạn')->timeOut(3000)
            ->toast();
            return redirect()->back();
        }
        $listPrice = null;
        $cart = new Cart();
        $listProduct = $cart->GetAll(session('user'));
        $ingredients = new Ingredients();
        foreach($listProduct as $a){
            $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
            foreach($listIngredients[$a->masanpham] as $b){
                $price += $b->dongia * $b->soluong;
            }
            $listPrice[$a->masanpham] = $price;
            $total += $listPrice[$a->masanpham] * $a->soluong;
            $price = 0; 
        }
        return view('user.pay', ['listProduct' => $listProduct, 'listPrice' => $listPrice, 'total' => $total, 'discount'=> $discount[0]->phantram]);
    }
    public function AddProductCart(){
        $cart = new Cart();
        $check = $cart->CheckCart(session('user'), $_REQUEST['idsp']);
        if(!$check){
            $product = $cart->InsertProductCart(session('user'), $_REQUEST['idsp']);
            return redirect('/giohang?id='.session('user'));
        }
        \Jeybin\Toastr\Toastr::error('Sản phẩm đã có trong giỏ')->timeOut(3000)
        ->toast();
        return redirect()->back();
    }
    public function DeleteProductCart(){
        $cart = new Cart();
        $delete = $cart->DeleteProductCart(session('user'), $_REQUEST['idsp']);
        return redirect("/giohang?id=".session('user'));
    }
    public function UpdateProductCart(){
        if($_REQUEST['quality'] < 1){
            return redirect("/giohang?id=".session('user'));
        }
        $cart = new Cart();
        $update = $cart->UpdateQuantity(session('user'), $_REQUEST['idsp'], $_REQUEST['quality']);
        return redirect("/giohang?id=".session('user'));
    }
    public function Payment(Request $request){
        $invoice = new Invoice();
        if(!$request->describe){
            $newinvoice = $invoice->AddInvoiceOnlineNoDesscribe($request->name, $request->phone, $request->address, $request->payment, $request->discount, session('user'));
        }
        else{
            $newinvoice = $invoice->AddInvoiceOnline($request->name, $request->phone, $request->address, $request->describe, $request->payment, $request->discount, session('user'));
        }
        if($request->payment == "Thanh toán trực tiếp"){
            $price = 0;
            $ingredients = new Ingredients();
            $cart = new Cart();
            $listCart = $cart->GetAll(session('user'));
            $idInvoice = $invoice->SearchInvoiceOnline(session('user'));
            foreach($listCart as $a){
                $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
                foreach($listIngredients[$a->masanpham] as $b){
                    $price += $b->dongia * $b->soluong;
                }
                $addProduct = $invoice->AddProductInvoice($idInvoice[0]->madonhang, $a->masanpham, $a->tensanpham, $price, $a->soluong, 0);
            }
            foreach($listCart as $a){
                $deleteProduct = $cart->DeleteProductCart(session('user'), $a->masanpham);
            }
            return redirect("/");
        }
        else{
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/xulythanhtoanvnpay";
            $vnp_TmnCode = "CN7TFJQS";//Mã website tại VNPAY 
            $vnp_HashSecret = "O1C4AD6PME925SFBJXST7HVYTX4RVXOX"; //Chuỗi bí mật
            $vnp_TxnRef = rand(00,9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Nội dung thanh toán';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->total * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );
            
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
        }
    }
    public function PaymentOnline(){
        $invoice = new Invoice();
        $idInvoice = $invoice->SearchInvoiceOnline(session('user'));
        if($_REQUEST['vnp_TransactionStatus'] == "00"){
            $price = 0;
            $ingredients = new Ingredients();
            $cart = new Cart();
            $listCart = $cart->GetAll(session('user'));
            $idInvoice = $invoice->SearchInvoiceOnline(session('user'));
            foreach($listCart as $a){
                $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
                foreach($listIngredients[$a->masanpham] as $b){
                    $price += $b->dongia * $b->soluong;
                }
                $addProduct = $invoice->AddProductInvoice($idInvoice[0]->madonhang, $a->masanpham, $a->tensanpham, $price, $a->soluong, 0);
            }
            foreach($listCart as $a){
                $deleteProduct = $cart->DeleteProductCart(session('user'), $a->masanpham);
            }
            \Jeybin\Toastr\Toastr::success('Thanh toán thành công')->timeOut(3000)
            ->toast();
            return redirect("/");
        }
        if($_REQUEST['vnp_TransactionStatus'] == "01"){
            $delete = $invoice->DeleteByID($idInvoice);
            \Jeybin\Toastr\Toastr::error('Giao dịch chưa hoàn tất')->timeOut(3000)
            ->toast();
            return redirect("/thanhtoan");
        }
        else{
            $delete = $invoice->DeleteByID($idInvoice);
            \Jeybin\Toastr\Toastr::error('Giao dịch bị lỗi')->timeOut(3000)
            ->toast();
            return redirect("/thanhtoan");
        }
    }
}
