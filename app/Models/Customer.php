<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    public function GetAll(){
        $customer = DB::select('SELECT * FROM khachhang INNER JOIN taikhoan WHERE khachhang.tendangnhap = taikhoan.taikhoan AND makhachhang <> 2');
        return $customer;
    }
    public function GetByID($id){
        $customer = DB::select('SELECT * FROM khachhang INNER JOIN taikhoan WHERE khachhang.tendangnhap = taikhoan.taikhoan AND makhachhang ='.$id);
        return $customer;
    }
    public function GetByLogin($name){
        $customer = DB::select('SELECT * FROM khachhang WHERE tendangnhap ="'.$name.'"');
        return $customer;
    }
    public function DisableByID($name){
        $customer  = DB::table('taikhoan')
                        ->where('taikhoan', $name)
                        ->update([
                            'trangthai' => 0
                        ]);
        return $customer;
    }
    public function ActiveByID($name){
        $customer  = DB::table('taikhoan')
                        ->where('taikhoan', $name)
                        ->update([
                            'trangthai' => 1
                        ]);
        return $customer;
    }
    public function NewCustomer($name, $age, $gentle, $phone, $email, $address, $account){
        $account = DB::table('khachhang')->insert([
            'tenkhachhang' => $name,
            'tuoi' => $age,
            'gioitinh' => $gentle,
            'sdt' => $phone,
            'email' => $email,
            'diachi' => $address,
            'tendangnhap' => $account
        ]);
        return $account;
    }
}
