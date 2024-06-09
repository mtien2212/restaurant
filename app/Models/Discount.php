<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Discount extends Model
{
    use HasFactory;
    public function GetAll(){
        $discount = DB::select('SELECT * FROM giamgia');
        return $discount;
    }
    public function SearchDiscount($code){
        $discount = DB::select('SELECT * FROM giamgia WHERE magiamgia="'.$code.'"');
        return $discount;
    }
    public function Insert($code, $percent, $start, $end){
        $discount = DB::table('giamgia')->insert([
            'magiamgia' => $code,
            'phantram' => $percent,
            'ngaybatdau' => $start,
            'ngayketthuc' => $end,
        ]);
        return $discount;
    }
    public function UpdateByID( $code, $percent, $start, $end){
        $discount  = DB::table('giamgia')
                        ->where('magiamgia', $code)
                        ->update(['magiamgia' => $code,
                        'phantram' => $percent,
                        'ngaybatdau' => $start,
                        'ngayketthuc' => $end,]);
        return $discount;
    }
    public function DeleteByID($code){
        $discount  = DB::table('giamgia')
                        ->where('magiamgia', $code)
                        ->delete();
        return $discount;
    }
}
