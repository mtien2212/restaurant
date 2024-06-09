<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TableController extends Controller
{
    //
    public function AllTable(){
        $table = new Table();
        $listTable = $table->GetAll();
        return view('admin.table')->with('listTable',$listTable);
    }
    public function AddTable(Request $request){
        $table = new Table();
        $insert = $table->Insert($request->name, $request->describe);
        return redirect('admin/banan');
    }
    public function UpdateTable(Request $request){
        $table = new Table();
        $update = $table->UpdateByID($request->id, $request->name, $request->describe);
        return redirect('admin/banan');
    }
    public function DisableTable(){
        $table = new Table();
        $delete = $table->DisableByID($_REQUEST['id']);
        return redirect('admin/banan');
    }
    public function ActiveTable(){
        $table = new Table();
        $delete = $table->ActiveByID($_REQUEST['id']);
        return redirect('admin/banan');
    }
    public function Book(){
        $table = new Table();
        $i = 0;
        $listTable = $table->GetAll();
        $date = $_REQUEST['date'];
        if( $date  == ""){
            $date = Carbon::tomorrow()->format('Y-m-d');
        }
        $tomorow = Carbon::tomorrow()->format('Y-m-d');
        foreach($listTable as $a){
            $status[$a->maban] = $table->GetBookByDay($date, $a->maban);
            if(!$status[$a->maban]){
                $s[$i] = 0;
            }
            else{
                $s[$i] = 1;
            }
            $i++;
        }
        return view('user.book',['listTable'=>$listTable, 's' => $s, 'count'=>$i, 'date'=>$date, 'tomorow'=>$tomorow]);
    }
    public function BookTable( Request $request){
        $table = new Table();
        $newbook = $table->NewBook($request->table, session('user'), $request->date, $request->time);
        return redirect('/datban?date=');
    }
    public function BookToday(){
        $table = new Table();
        $i = 0;
        $listTable = $table->GetAll();
        $date = Carbon::now()->format('Y-m-d');
        foreach($listTable as $a){
            $status[$a->maban] = $table->GetBookByDay($date, $a->maban);
        }
        return view('employee.order',['listTable'=>$listTable, 'status' => $status, 'count'=>$i]);
    }
    public function CheckBook(){
        $table = new Table();
        $date = Carbon::now()->format('Y-m-d');
        $listBook = $table->GetAllBook($date);
        return view('employee.book',['listBook'=>$listBook]);
    }
    public function Cancel(){
        $table = new Table();
        $cancel = $table->DeleteByID($_REQUEST['id'], $_REQUEST['date']);
        return redirect("/nhanvien/datban");
    }
}
