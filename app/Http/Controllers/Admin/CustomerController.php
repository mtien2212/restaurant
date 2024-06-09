<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function AllCustomer(){
        $customer = new Customer();
        $listCustomer = $customer->GetAll();
        return view('admin.customers')->with('listCustomer', $listCustomer);
    }
    public function DisableCustomer(){
        $customer = new Customer();
        $disable = $customer->DisableByID($_REQUEST['name']);
        $listCustomer = $customer->GetAll();
        return view('admin.customers')->with('listCustomer', $listCustomer);
    }
    public function ActiveCustomer(){
        $customer = new Customer();
        $disable = $customer->ActiveByID($_REQUEST['name']);
        $listCustomer = $customer->GetAll();
        return view('admin.customers')->with('listCustomer', $listCustomer);
    }
}
