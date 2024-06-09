<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Acount extends Model
{
    use HasFactory;
    public function GetAcount($name, $password){
        $account = DB::select('SELECT * FROM taikhoan WHERE taikhoan= "'.$name.'" AND matkhau ="'.$password.'"');
        return $account;
    }
    public function GetInf($name){
        $account = DB::select('SELECT * FROM taikhoan WHERE taikhoan= "'.$name.'"');
        return $account;
    }
    public function NewCustomer($name, $password){
        $account = DB::table('taikhoan')->insert([
            'taikhoan' => $name,
            'matkhau' => $password,
            'vaitro' => 2
        ]);
        return $account;
    }
}
