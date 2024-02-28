<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{

    public function index()
    {

  $employees = Employee::orderBy('created_at', 'desc')->paginate(5);

//dd( $employees->all());


        return view('emp.index', ["employees" => $employees   ]);
    }
}
