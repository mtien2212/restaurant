<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Acount;

class EmployeeController extends Controller
{
    //
    public function AllEmployee(){
        $employee = new Employee();
        $listEmployee = $employee->GetAll();
        return view('admin.employees')->with('listEmployee', $listEmployee);
    }
    public function AddEmployee(Request $request){
        $employee = new Employee();
        $insert = $employee->Insert($request->name, $request->age, $request->gentle, $request->phone, $request->email, $request->home, $request->address, $request->role);
        return redirect('admin/nhanvien');
    }
    public function UpdateEmployee(Request $request){
        $employee = new Employee();
        $update = $employee->UpdateByID($request->id, $request->name, $request->age, $request->gentle, $request->phone, $request->email, $request->home, $request->address, $request->role);
        return redirect('admin/nhanvien');
    }
    public function DisableEmployee(){
        $employee = new Employee();
        $disable = $employee->DisableByID($_REQUEST['name']);
        return redirect('admin/nhanvien');
    }
    public function ActiveEmployee(){
        $employee = new Employee();
        $disable = $employee->ActiveByID($_REQUEST['name']);
        return redirect('admin/nhanvien');
    }
}
