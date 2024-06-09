<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function AllNews(){
        $news = new News();
        $listNews = $news->GetAll();
        return view('admin.news')->with('listNews',$listNews);
    }
    public function News(){
        $news = new News();
        $listNews = $news->GetAll();
        return view('user.news')->with('listNews',$listNews);
    }
    public function AddNews(Request $request){
        $category = new News();
        $insert = $category->Insert($request->title, $request->content);
        return redirect('admin/tintuc');
    }
    public function UpdateNews(Request $request){
        $category = new News();
        $update = $category->UpdateByID($request->id, $request->title, $request->content);
        return redirect('admin/tintuc');
    }
    public function DeleteNews(){
        $category = new News();
        $delete = $category->DeleteByID($_REQUEST['id']);
        return redirect('admin/tintuc');
    }
}
