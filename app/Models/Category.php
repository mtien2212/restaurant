<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    public function GetAll(){
        $category = DB::select('SELECT * FROM loaisanpham ORDER BY maloaisanpham DESC');
        return $category;
    }
    public function List(){
        $category = DB::select('SELECT * FROM loaisanpham WHERE trangthai <> 0 ORDER BY maloaisanpham ');
        return $category;
    }
    public function Insert($name){
        $category = DB::table('loaisanpham')->insert([
            'tenloaisanpham' => $name,
        ]);
        return $category;
    }
    public function UpdateByID($id, $name){
        $category  = DB::table('loaisanpham')
                        ->where('maloaisanpham', $id)
                        ->update(['tenloaisanpham' => $name]);
        return $category;
    }
    public function DisableByID($id){
        $category  = DB::table('loaisanpham')
                        ->where('maloaisanpham', $id)
                        ->update(['trangthai' => 0]);
        return $category;
    }
    public function ActiveByID($id){
        $category  = DB::table('loaisanpham')
                        ->where('maloaisanpham', $id)
                        ->update(['trangthai' => 1]);
        return $category;
    }
}
