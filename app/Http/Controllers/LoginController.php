<?php

namespace App\Http\Controllers;

use App\Models\Acount;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function Login(Request $request){
        $acount = new Acount();
        $check = $acount->GetAcount($request->name, $request->password);
        if(!$check){
            \Jeybin\Toastr\Toastr::error('Tài khoản không tồn tại')->timeOut(3000)
            ->toast();
            return view("login");
        }
        else{
            if($check[0]->trangthai == 0){
                \Jeybin\Toastr\Toastr::error('Tài khoản bị vô hiệu hóa')->timeOut(3000)
            ->toast();
                return view("login");
            }
            else{
                if($check[0]->vaitro == 0){
                    session()->put('admin', 'admin');
                    \Jeybin\Toastr\Toastr::success('Đăng nhập thành công')->timeOut(3000)
                    ->toast();
                    return redirect('admin/loaisanpham');
                }
                else if($check[0]->vaitro == 1){
                    $employee = new Employee();
                    $name_employee = $employee->GetByLogin($request->name);
                    session()->put('employee', $name_employee[0]->tennhanvien);
                    \Jeybin\Toastr\Toastr::success('Đăng nhập thành công')->timeOut(3000)
                    ->toast();
                    return redirect('nhanvien/duyetdon');
                }
                else{
                    $customer = new Customer();
                    $name_customer = $customer->GetByLogin($check[0]->taikhoan);
                    session()->put('user', $name_customer[0]->makhachhang);
                    \Jeybin\Toastr\Toastr::success('Đăng nhập thành công')->timeOut(3000)
                    ->toast();
                    return redirect('/');
                }
            }
        }
    }
    public function Logout(){
        session()->flush();
        return redirect('/');
    }
}
