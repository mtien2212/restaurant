<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class News extends Model
{
    use HasFactory;
    public function GetAll(){
        $news = DB::select('SELECT * FROM tintuc');
        return $news;
    }
    public function Insert($title, $content){
        $category = DB::table('tintuc')->insert([
            'tieude' => $title,
            'noidung'=> $content 
        ]);
        return $category;
    }
    public function UpdateByID($id, $title, $content){
        $category  = DB::table('tintuc')
                        ->where('matintuc', $id)
                        ->update([
                            'tieude' => $title,
                            'noidung'=> $content 
                        ]);
        return $category;
    }
    public function DeleteByID($id){
        $category  = DB::table('tintuc')
                        ->where('matintuc', $id)
                        ->delete();
        return $category;
    }
}
