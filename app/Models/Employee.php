<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;
    public function GetAll(){
        $employee = DB::select('SELECT * FROM nhanvien INNER JOIN taikhoan WHERE nhanvien.tendangnhap = taikhoan.taikhoan');
        return $employee;
    }
    public function GetByID($id){
        $employee = DB::select('SELECT * FROM nhanvien INNER JOIN taikhoan WHERE nhanvien.tendangnhap = taikhoan.taikhoan AND manhanvien = '.$id);
        return $employee;
    }
    public function GetByLogin($name){
        $employee = DB::select('SELECT * FROM nhanvien  WHERE tendangnhap ='.$name);
        return $employee;
    }
    public function Insert($name, $age, $gentle, $phone, $email, $home, $address, $role){
        $account  = DB::table('taikhoan')->insert([
            'taikhoan' => $phone,
            'matkhau' => '123456',
            'vaitro' => 1,
            'trangthai' => 1
        ]);
        $employee = DB::table('nhanvien')->insert([
            'tennhanvien' => $name,
            'tuoi' => $age,
            'gioitinh' => $gentle,
            'sdt' => $phone,
            'email' => $email,
            'quequan' => $home,
            'diachi' => $address,
            'chucvu' => $role,
            'tendangnhap' => $phone
        ]);
        return $employee;
    }
    public function UpdateByID($id, $name, $age, $gentle, $phone, $email, $home, $address, $role){
        $employee  = DB::table('nhanvien')
                        ->where('manhanvien', $id)
                        ->update([
                            'tennhanvien' => $name,
                            'tuoi' => $age,
                            'gioitinh' => $gentle,
                            'sdt' => $phone,
                            'email' => $email,
                            'quequan' => $home,
                            'diachi' => $address,
                            'chucvu' => $role,
                        ]);
        return $employee;
    }
    public function DisableByID($name){
        $employee  = DB::table('taikhoan')
                        ->where('taikhoan', $name)
                        ->update([
                            'trangthai' => 0
                        ]);
        return $employee;
    }
    public function ActiveByID($name){
        $employee  = DB::table('taikhoan')
                        ->where('taikhoan', $name)
                        ->update([
                            'trangthai' => 1
                        ]);
        return $employee;
    }
}
