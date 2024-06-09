<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Category;
use App\Models\Product;
use App\Models\Ingredients;
use App\Models\Discount;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function AllInvoiceOnline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->AllInvoiceOnline();
        return view('admin.invoice_online')->with('listInvoice',$listInvoice);
    }
    public function CheckInvoiceOnline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->CheckInvoiceOnline();
        $price = 0;
        $t=0;
        $discount = 0;
        $listPrice = null;
        $listProduct = null;
        $total = null;
        foreach($listInvoice as $c){
            $listProduct[$c->madonhang] = $invoice->DetailInvoice($c->madonhang);
            $ingredients = new Ingredients();
            foreach($listProduct[$c->madonhang]  as $a){
                $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
                foreach($listIngredients[$a->masanpham] as $b){
                    $price += $b->dongia * $b->soluong;
                }
                $listPrice[$a->masanpham] = $price;
                $t += $listPrice[$a->masanpham] * $a->soluong;
                $price = 0; 
            }
            $total[$c->madonhang] = $t;
            $t = 0;
        }
       return view('employee.invoice_online', ['listInvoice' => $listInvoice,'listProduct' => $listProduct, 'listPrice' => $listPrice, 'total' => $total, 'discount'=> $discount]);
    }
    public function AcceptInvoiceOnline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->AcceptInvoiceOnline($_REQUEST['id'], session('employee'));
        return redirect("/nhanvien/duyetdon");
    }
    public function CancelInvoiceOnline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->CancelInvoiceOnline($_REQUEST['id'], session('employee'));
        return redirect("/nhanvien/duyetdon");
    }
    public function CookInvoiceOnline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->CookInvoiceOnline();
        $listProduct = null;
        $listIngredients = null;
        foreach($listInvoice as $c){
            $listProduct[$c->madonhang] = $invoice->DetailInvoice($c->madonhang);
            $ingredients = new Ingredients();
            foreach($listProduct[$c->madonhang]  as $a){
                $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
            }
        }
       return view('employee.chef_invoice_online', ['listInvoice' => $listInvoice,'listProduct' => $listProduct, 'listIngredients' => $listIngredients]);
    }
    public function CookDoneInvoiceOnline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->CookDoneInvoiceOnline($_REQUEST['id'], session('employee'));
        return redirect("/nhanvien/antainha");
    }
    public function ShipInvoiceOnline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->ShipInvoiceOnline();
        $price = 0;
        $t=0;
        $discount = 0;
        $listPrice = null;
        $listProduct = null;
        $total = null;
        foreach($listInvoice as $c){
            $listProduct[$c->madonhang] = $invoice->DetailInvoice($c->madonhang);
            $ingredients = new Ingredients();
            foreach($listProduct[$c->madonhang]  as $a){
                $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
                foreach($listIngredients[$a->masanpham] as $b){
                    $price += $b->dongia * $b->soluong;
                }
                $listPrice[$a->masanpham] = $price;
                $t += $listPrice[$a->masanpham] * $a->soluong;
                $price = 0; 
            }
            $total[$c->madonhang] = $t;
            $t = 0;
        }
       return view('employee.ship', ['listInvoice' => $listInvoice,'listProduct' => $listProduct, 'listPrice' => $listPrice, 'total' => $total, 'discount'=> $discount]);
    }
    public function ShipDoneInvoiceOnline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->ShipDoneInvoiceOnline($_REQUEST['id'], session('employee'));
        return redirect("/nhanvien/shipdon");
    }
    public function AllInvoiceOffline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->AllInvoiceOffline();
        return view('admin.invoice_offline')->with('listInvoice',$listInvoice);
    }
    public function DetailInvoice(){
        $invoice = new Invoice();
        $price = 0;
        $total = 0;
        $stt = 1;
        $listPrice = null;
        $detail = $invoice->GetInvoiceByID($_REQUEST['id']);
        $listProduct = $invoice->DetailInvoiceOffline($_REQUEST['id']);
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
        return view('admin.detail', ['listProduct' => $listProduct, 'listPrice' => $listPrice, 'total' => $total, 'detail'=> $detail, 'stt'=> $stt, 'id'=>$_REQUEST['id']]);
    }
    public function DetailShip(){
        $invoice = new Invoice();
        $price = 0;
        $total = 0;
        $stt = 1;
        $listPrice = null;
        $detail = $invoice->GetInvoiceByID($_REQUEST['id']);
        $listProduct = $invoice->DetailInvoiceOffline($_REQUEST['id']);
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
        return view('employee.ship_detail', ['listProduct' => $listProduct, 'listPrice' => $listPrice, 'total' => $total, 'detail'=> $detail, 'stt'=> $stt, 'id'=>$_REQUEST['id']]);
    }
    public function NewInvoiceOffline(){
        $invoice = new Invoice();
        $new = $invoice->OpenInvoiceOffline($_REQUEST['idb'], );
        $iddh = $invoice->SearchInvoiceOffline($_REQUEST['idb']);
        return redirect("/nhanvien/themmon?id=3&idb=".$iddh[0]->maban) ;
    }
    public function InvoiceOffline(){
        $price = 0;
        $category = new Category();
        $listCategory = $category->List();
        $product = new Product();
        $listProduct = $product->GetProductByCategory($_REQUEST['id']);
        $ingredients = new Ingredients(); 
        $listIngredients = null;
        $listPrice = null;
        foreach($listProduct as $a){
            $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
            foreach($listIngredients[$a->masanpham] as $b){
                $price += $b->dongia*$b->soluong;
            }
            $listPrice[$a->masanpham] = $price;
            $price = 0;
        }
        $invoice = new Invoice();
        $iddh = $invoice->SearchInvoiceOffline($_REQUEST['idb']);
        $idb = $_REQUEST['idb'];
        $allProduct = $invoice->DetailInvoiceOffline($iddh[0]->madonhang);
        return view('employee.order_table',['listProduct' => $listProduct, 'listCategory' => $listCategory, 'listIngredients' => $listIngredients, 'listPrice' => $listPrice, 'allProduct' => $allProduct, 'iddh'=>$iddh, 'idb'=>$idb]);
    }
    public function AddProductInvoiceOffline(){
        $invoice = new Invoice();
        $product = new Product();
        $ingredients = new Ingredients(); 
        $listIngredients = null;
        $price=0;
        $pro = $product->GetProductByID($_REQUEST['id']);
        $listIngredients = $ingredients->GetIngredientByProduct($_REQUEST['id']);
        foreach($listIngredients as $b){
            $price += $b->dongia*$b->soluong;
        }
        $product = $invoice->AddProductInvoice($_REQUEST['iddh'], $_REQUEST['id'], $pro[0]->tensanpham, $price, 1, "Đang nấu");
        return redirect()->back();
    }
    public function UpdateQuality(){
        if($_REQUEST['quality'] < 1){
            return redirect()->back();
        }
        $invoice = new Invoice();
        $update = $invoice->UpdateQuantity($_REQUEST['iddh'], $_REQUEST['id'], $_REQUEST['quality']);
        return redirect()->back();
    }
    public function DeleteProductInvoiceOffline(){
        $invoice = new Invoice();
        $product = $invoice->DeleteProductInvoice($_REQUEST['iddh'], $_REQUEST['id']);
        return redirect()->back();
    }
    public function Payment(){
        $price = 0;
        $total = 0;
        $stt = 1;
        $listPrice = null;
        $invoice = new Invoice();
        $iddh = $invoice->GetInvoiceByID($_REQUEST['id']);
        if($_REQUEST['code'] == null){
            $end = $invoice->CloseInvoiceOffline($_REQUEST['id'], $iddh[0]->maban, 0, $_REQUEST['payment']);
        }
        else{
            $search = new Discount();
            $discount = $search->SearchDiscount($_REQUEST['code']);
            if(!$discount){
                \Jeybin\Toastr\Toastr::error('Mã giảm giá không tồn tại')->timeOut(3000)
                ->toast();
                return redirect()->back();
            }
            $start = Carbon::parse($discount[0]->ngaybatdau);
            if($start->isFuture()){
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
            $end = $invoice->CloseInvoiceOffline($_REQUEST['id'], $iddh[0]->maban, $discount[0]->phantram, $_REQUEST['payment']);
        }
        $detail = $invoice->GetInvoiceByID($_REQUEST['id']);
        $listProduct = $invoice->DetailInvoiceOffline($_REQUEST['id']);
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
        return view('employee.invoice', ['listProduct' => $listProduct, 'listPrice' => $listPrice, 'total' => $total, 'detail'=> $detail, 'stt'=> $stt]);
    }
    public function CookInvoiceOffline(){
        $invoice = new Invoice();
        $ingredients = new Ingredients();
        $listIngredients = null;
        $listProduct = $invoice->CookInvoiceOffline();
            foreach($listProduct as $a){
                $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
            }
       return view('employee.chef_invoice_offline', ['listProduct' => $listProduct, 'listIngredients' => $listIngredients]);
    }
    public function CookDoneInvoiceOffline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->CookDoneInvoiceOffline($_REQUEST['iddh'], $_REQUEST['idsp']);
        return redirect("/nhanvien/antaiquan");
    }
    public function DishupInvoiceOffline(){
        $invoice = new Invoice();
        $ingredients = new Ingredients();
        $listIngredients = null;
        $listProduct = $invoice->DishupInvoiceOffline();
            foreach($listProduct as $a){
                $listIngredients[$a->masanpham] = $ingredients->GetIngredientByProduct($a->masanpham);
            }
       return view('employee.dishup', ['listProduct' => $listProduct, 'listIngredients' => $listIngredients]);
    }
    public function DishupDoneInvoiceOffline(){
        $invoice = new Invoice();
        $listInvoice = $invoice->DishupDoneInvoiceOffline($_REQUEST['iddh'], $_REQUEST['idsp']);
        return redirect("/nhanvien/lenmon");
    }
}
