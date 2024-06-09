<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    //
    public function AllDiscount(){
        $discount = new Discount();
        $listDiscount = $discount->GetAll();
        return view('admin.discount')->with('listDiscount',$listDiscount);
    }
    public function AddDiscount(Request $request){
        $discount = new Discount();
        $insert = $discount->Insert($request->code, $request->percent, $request->start, $request->end);
        return redirect('admin/giamgia');
    }
    public function UpdateDiscount(Request $request){
        $discount = new Discount();
        $update = $discount->UpdateByID($request->code, $request->percent, $request->start, $request->end);
        return redirect('admin/giamgia');
    }
    public function DeleteDiscount(){
        $discount = new Discount();
        $delete = $discount->DeleteByID($_REQUEST['id']);
        return redirect('admin/giamgia');
    }
}
