<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ingredients extends Model
{
    use HasFactory;
    public function GetAll(){
        $ingredients = DB::select('SELECT * FROM nguyenlieu');
        return $ingredients;
    }
    public function GetIngredientByProduct($id){
        $ingredients = DB::select('SELECT nguyenlieusanpham.manguyenlieu, soluong, tennguyenlieu, trongluong_thetich, donvi, dongia, trangthai FROM nguyenlieusanpham INNER JOIN nguyenlieu WHERE nguyenlieusanpham.manguyenlieu = nguyenlieu.manguyenlieu AND nguyenlieu.trangthai <> 0 AND nguyenlieusanpham.masanpham = '.$id);
        return $ingredients;
    }
    // public function GetProductByID($id){
    //     $ingredients = DB::select("SELECT * FROM sanpham WHERE masanpham =".$id);
    //     return $ingredients;
    // }
    public function GetIngredientsByName($name){
        $ingredients = DB::select("SELECT * FROM nguyenlieu  WHERE nguyenlieu.trangthai <> 0 AND tennguyenlieu LIKE '%$name%'");
        return $ingredients;
    }
    public function Insert($name, $weight, $unit, $price){
        $ingredients = DB::table('nguyenlieu')->insert([
            'tennguyenlieu' => $name,
            'trongluong_thetich' => $weight,
            'donvi' => $unit,
            'dongia' => $price
        ]);
        return $ingredients;
    }
    public function UpdateByID($id, $name, $weight, $unit, $price){
        $ingredients  = DB::table('nguyenlieu')
                        ->where('manguyenlieu', $id)
                        ->update([
                            'tennguyenlieu' => $name,
                            'trongluong_thetich' => $weight,
                            'donvi' => $unit,
                            'dongia' => $price
                        ]);
        return $ingredients;
    }
    public function DisableByID($id){
        $ingredients  = DB::table('nguyenlieu')
                        ->where('manguyenlieu', $id)
                        ->update([ 'trangthai' => 0]);
        return $ingredients;
    }
    public function ActiveByID($id){
        $ingredients  = DB::table('nguyenlieu')
                        ->where('manguyenlieu', $id)
                        ->update([ 'trangthai' => 1]);
        return $ingredients;
    }
    public function InsertProductIngredients($idp, $idi){
        $ingredients = DB::table('nguyenlieusanpham')->insert([
            'masanpham' => $idp,
            'manguyenlieu' => $idi,
            'soluong' => 1
        ]);
        return $ingredients;
    }
    public function DeleteProductIngredients($id, $idi){
        $ingredients  = DB::table('nguyenlieusanpham')
                        ->where('manguyenlieu', $idi)
                        ->where('masanpham', $id)
                        ->delete();
        return $ingredients;
    }
    public function CheckProductIngredients($idp, $idi){
        $ingredients = DB::select("SELECT * FROM nguyenlieusanpham  WHERE manguyenlieu=".$idi." AND masanpham=".$idp);
        return $ingredients;
    }
    public function UpdateQuantity($id, $idi, $number){
        $ingredients  = DB::table('nguyenlieusanpham')
                        ->where('manguyenlieu', $idi)
                        ->where('masanpham', $id)
                        ->update([
                            'soluong' => $number,
                        ]);
        return $ingredients;
    }
}
