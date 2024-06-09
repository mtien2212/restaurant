<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    //
    public function Revenue(){
        $invoice = new Invoice();
        if($_REQUEST['year'] == null){
            $year = Carbon::now()->format('Y');
        }
        else{
            $year = $_REQUEST['year'];
        }
        $listInvoice = null;
        for($i = 0; $i < 12;$i++){
             $a[$i] = $invoice->GetInvoiceByMonth($i+1, $year);
             $listInvoice[$i] = (int)$a[$i][0]->doanhthu;
        }
        $JsonInvoice = json_encode($listInvoice);
        //return dd($JsonInvoice);
        return view('admin.revenue',['listInvoice' => $JsonInvoice]);
    }
    public function StatisticInvoiceOnline(){
        $invoice = new Invoice();
        if($_REQUEST['year'] == null){
            $year = Carbon::now()->format('Y');
        }
        else{
            $year = $_REQUEST['year'];
        }
        if($_REQUEST['month'] == null){
            $month = Carbon::now()->format('m');
        }
        else{
            $month = $_REQUEST['month'];
        }
        $listCheck = null;
        $listCook = null;
        $listShip = null;
        $listNumCheck = null;
        $listNumCook = null;
        $listNumShip = null;
        
        $listCheckInvoice = $invoice->CountCheckInvoiceOnline($month, $year);
        $listCookInvoice = $invoice->CountCookInvoiceOnline($month, $year);
        $listShipInvoice = $invoice->CountShipInvoiceOnline($month, $year);
        $i = 0;
        foreach($listCheckInvoice as $a){ 
            if($a->duyetdon != null){
                $listCheck[$i] = $a->duyetdon;
                $listNumCheck[$i] = $a->sodon;
                $i++;
            }
        }
        $i = 0;
        foreach($listCookInvoice as $a){ 
            if($a->naudon != null){
                $listCook[$i] = $a->naudon;
                $listNumCook[$i] = $a->sodon;
                $i++;
            }
        }
        $i = 0;
        foreach($listShipInvoice as $a){ 
            if($a->vanchuyen != null){
                $listShip[$i] = $a->vanchuyen;
                $listNumShip[$i] = $a->sodon;
                $i++;
            }
        }
        $JsonCheck = json_encode($listCheck, JSON_UNESCAPED_UNICODE);
        $JsonNumCheck = json_encode($listNumCheck);
        $JsonCook = json_encode($listCook, JSON_UNESCAPED_UNICODE);
        $JsonNumCook = json_encode($listNumCook);
        $JsonShip = json_encode($listShip, JSON_UNESCAPED_UNICODE);
        $JsonNumShip = json_encode($listNumShip);
        //return dd($JsonCheck);
        return view('admin.statistic_invoice_online',['JsonCheck' => $JsonCheck,'JsonNumCheck' => $JsonNumCheck, 'JsonCook' => $JsonCook, 'JsonNumCook' => $JsonNumCook, 'JsonShip' => $JsonShip, 'JsonNumShip' => $JsonNumShip, 'month' => $month]);
    }
}
