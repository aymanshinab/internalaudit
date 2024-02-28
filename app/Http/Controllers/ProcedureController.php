<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    public function index()
    {
       // $transactions =  DB::table('transactions')
            //->join('employees', 'transactions.employee_id', '=', 'employees.id')
          //  ->select('employees.name AS employee_name', 'transactions.*')
           // ->where('transactions.id', $transactionId)
//->first();

         //  dd($transactions->all());

       //  $procedures = Procedures::all();

//return view('transaction.index', ['procedures' => $procedures]);
    }

}
