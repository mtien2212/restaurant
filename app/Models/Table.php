<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Table extends Model
{
    use HasFactory;
    public function GetAll(){
        $table = DB::select('SELECT * FROM ban WHERE maban <> "0"');
        return $table;
    }
    
    public function GetBookByDay($date, $id){
        $table = DB::select('SELECT * FROM datban INNER JOIN ban WHERE ban.maban = datban.maban AND ban.maban = "'.$id.'" AND ngaydat = "'.$date.'"');
        return $table;
    }
    public function GetAllBook($date){
        $table = DB::select('SELECT * FROM datban INNER JOIN khachhang WHERE datban.makhachhang = khachhang.makhachhang AND ngaydat >= "'.$date.'"');
        return $table;
    }
    public function GetBookByCustomer($id){
        $table = DB::select('SELECT * FROM datban INNER JOIN khachhang WHERE datban.makhachhang = khachhang.makhachhang AND khachhang.makhachhang = '.$id);
        return $table;
    }
    public function Insert($name, $describe){
        $table = DB::table('ban')->insert([
            'maban' => $name,
            'mota' => $describe
        ]);
        return $table;
    }
    public function UpdateByID($id, $name, $describe){
        $table  = DB::table('ban')
                        ->where('maban', $id)
                        ->update(['maban' => $name,
                        'mota' => $describe]);
        return $table;
    }
    public function DisableByID($id){
        $category  = DB::table('ban')
                        ->where('maban', $id)
                        ->update(['trangthai' => 'Đang bị khóa']);
        return $category;
    }
    public function ActiveByID($id){
        $category  = DB::table('ban')
                        ->where('maban', $id)
                        ->update(['trangthai' => 'Trống']);
        return $category;
    }
    public function NewBook($id, $customer, $date, $time){
        $table = DB::table('datban')->insert([
            'maban' => $id,
            'makhachhang' => $customer,
            'ngaydat' => $date,
            'giodat' => $time,
        ]);
        return $table;
    }
    public function DeleteByID($id, $date){
        $table  = DB::table('datban')
                        ->where('maban', $id)
                        ->where('ngaydat', $date)
                        ->delete();
        return $table;
    }
}
