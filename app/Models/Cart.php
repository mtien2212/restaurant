<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;
    public function GetAll($id){
        $product = DB::select('SELECT  tensanpham, hinhanh, soluong, sanpham.trangthai, sanpham.masanpham FROM giohang INNER JOIN sanpham WHERE sanpham.masanpham = giohang.masanpham AND sanpham.trangthai <> 0 AND giohang.makhachhang='.$id);
        return $product;
    }
    public function CheckCart($idkh, $idsp){
        $product = DB::select('SELECT * FROM giohang  WHERE masanpham = '.$idsp.' AND makhachhang ='.$idkh);
        return $product;
    }
    public function InsertProductCart($idkh, $idsp){
        $product = DB::table('giohang')->insert([
            'makhachhang' => $idkh,
            'masanpham' => $idsp,
            'soluong' => 1
        ]);
        return $product;
    }
    public function DeleteProductCart($idkh, $idsp){
        $ingredients  = DB::table('giohang')
                        ->where('makhachhang', $idkh)
                        ->where('masanpham', $idsp)
                        ->delete();
        return $ingredients;
    }
    public function UpdateQuantity($idkh, $idsp, $number){
        $ingredients  = DB::table('giohang')
                        ->where('makhachhang', $idkh)
                        ->where('masanpham', $idsp)
                        ->update([
                            'soluong' => $number,
                        ]);
        return $ingredients;
    }
}
