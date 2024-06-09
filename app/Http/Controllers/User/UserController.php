<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Acount;
use App\Models\Invoice;
use App\Models\Table;
use App\Models\Ingredients;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function Register(Request $request){
        $account = new Acount();
        $acc = $account->NewCustomer($request->account, $request->password);
        $check = $account->GetAcount($request->name, $request->password);
        $customer = new Customer();
        $inf = $customer->NewCustomer($request->name, $request->age, $request->gentle, $request->number, $request->email, $request->address, $request->account);
        $name_customer = $customer->GetByLogin($check[0]->taikhoan);
        session()->put('user', $name_customer[0]->makhachhang);
        return redirect('/');
    }
    public function Information(){
        $customer = new Customer();
        $inf = $customer->GetByID(session('user'));
        $account = new Acount();
        $acc = $account->GetInf($inf[0]->tendangnhap);
        return view('user.infor', ['inf'=>$inf, 'acc'=>$acc]);
    }
    public function HistoryInvoice(){
        $invoice = new Invoice();
        $listInvoice = $invoice->GetInvoiceByCustomer(session('user'));
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
       return view('user.history_invoice', ['listInvoice' => $listInvoice,'listProduct' => $listProduct, 'listPrice' => $listPrice, 'total' => $total, 'discount'=> $discount]);
    }
    public function HistoryBook(){
        $table = new Table();
        $book = $table->GetBookByCustomer(session('user'));
        return view('user.history_book')->with('listBook', $book);
    }
}
