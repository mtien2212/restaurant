<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    public function GetAll(){
        $product = DB::select('SELECT masanpham, tensanpham, hinhanh, sanpham.trangthai, loaisanpham.maloaisanpham, tenloaisanpham FROM sanpham INNER JOIN loaisanpham WHERE sanpham.maloaisanpham = loaisanpham.maloaisanpham ORDER BY sanpham.masanpham DESC');
        return $product;
    }
    public function HomeProduct(){
        $product = DB::select('SELECT masanpham, tensanpham, hinhanh, sanpham.trangthai, loaisanpham.maloaisanpham, tenloaisanpham FROM sanpham INNER JOIN loaisanpham WHERE sanpham.maloaisanpham = loaisanpham.maloaisanpham AND sanpham.trangthai <> 0  ORDER BY sanpham.masanpham DESC LIMIT 10');
        return $product;
    }
    public function GetProductInvoiceOffline(){
        $product = DB::select('SELECT masanpham, tensanpham, hinhanh, sanpham.trangthai, loaisanpham.maloaisanpham, tenloaisanpham FROM sanpham INNER JOIN loaisanpham WHERE sanpham.maloaisanpham = loaisanpham.maloaisanpham ORDER BY sanpham.masanpham DESC');
        return $product;
    }
    public function GetProductByCategory($id){
        $product = DB::select('SELECT * FROM sanpham INNER JOIN loaisanpham WHERE sanpham.maloaisanpham = loaisanpham.maloaisanpham AND sanpham.trangthai <> 0 AND sanpham.maloaisanpham = '.$id);
        return $product;
    }
    public function GetProductByID($id){
        $product = DB::select("SELECT * FROM sanpham WHERE masanpham =".$id);
        return $product;
    }
    public function GetProductByName($name){
        $product = DB::select("SELECT * FROM sanpham  WHERE  tensanpham LIKE '%$name%'");
        return $product;
    }
    public function Insert($name, $image, $idCategory){
        $product = DB::table('sanpham')->insert([
            'tensanpham' => $name,
            'hinhanh' => $image,
            'trangthai' => 1,
            'maloaisanpham' => $idCategory
        ]);
        return $product;
    }
    public function UpdateByID($id, $name, $image, $idCategory){
        $product  = DB::table('sanpham')
                        ->where('masanpham', $id)
                        ->update([
                            'tensanpham' => $name,
                            'hinhanh' => $image,
                            'maloaisanpham' => $idCategory
                        ]);
        return $product;
    }
    public function UpdateByIDNoPhoto($id, $name, $idCategory){
        $product  = DB::table('sanpham')
                        ->where('masanpham', $id)
                        ->update([
                            'tensanpham' => $name,
                            'maloaisanpham' => $idCategory
                        ]);
        return $product;
    }
    public function DisableByID($id){
        $product  = DB::table('sanpham')
                        ->where('masanpham', $id)
                        ->update([ 'trangthai' => 0]);
        return $product;
    }
    public function ActiveByID($id){
        $product  = DB::table('sanpham')
                        ->where('masanpham', $id)
                        ->update([ 'trangthai' => 1]);
        return $product;
    }
}
