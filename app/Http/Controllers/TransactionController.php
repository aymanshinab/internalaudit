<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Procedure;
use App\Models\Employee;
use App\Models\Notice;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
class TransactionController extends Controller
{


    public function adminindex()
    {


            $transactions = Transaction::orderBy('created_at', 'desc')->paginate(5);
          //  dd( $transactions->all());
            return view('transaction.adminindex', [ "transactions" => $transactions  ]);
        }

        public function admincreate()
        {
            return view('transaction.admincreate');
        }

        public function adminstore(Request $request)
    {
        $req = $request->validate([
            'year' => 'required',
            'management_id' => 'required',
            'month' => 'required',
            'data' => 'required',
            'type' => 'required',
            'idnum' => 'nullable|integer',
            'summary' => 'nullable|integer',
        ]);





        $user = Auth::user();

        $transaction = new Transaction($req);
        $transaction->save();

        $procedure = new Procedure();
        $procedure->transaction_id = $transaction->id;
        $procedure->user_id = $user->id;
        $procedure->procedure_types_id = 1;
        $procedure->save();

            return redirect(route("transaction.adminindex"));

        }






        public function adminshow(Transaction $transaction)
   {

    $query = DB::raw('IFNULL(employees.name, users.name) AS name');


    $procedures = DB::table('procedures')
    ->leftjoin('employees', 'procedures.employee_id', '=', 'employees.id')
    ->leftjoin('users', 'procedures.user_id', '=', 'users.id')
    ->join('procedure_types', 'procedures.procedure_types_id', '=', 'procedure_types.id')
    ->leftjoin('employees AS to_employees', 'procedures.to_employee', '=', 'to_employees.id')
    ->select($query, 'procedure_types.name AS procedure_name', 'procedures.created_at AS procedure_time', 'to_employees.name AS to_name' , 'procedures.*')
    ->where('procedures.transaction_id', $transaction->id)
    ->orderByDesc('procedure_time')
    ->get();

    //dd($procedures);
    $employees = DB::table('employees')->get();
       return view('transaction.adminshow', [
           'transaction' => $transaction,
           'procedures' => $procedures,
           'employees' => $employees,
       ]);
   }

   public function adminedit(Transaction $transaction)
   {

       return view('transaction.adminshow', [ 'transaction' => $transaction,]);
   }


   public function adminupdate(Request $request, Transaction $transaction)
   {
       $contents = $request->input('content');
       $managements = $request->input('management_id');



       $validatedData = $request->validate([
           'transactions_type' => 'required',
           'to_employee' => 'nullable',
       ]);


       $user = Auth::user();

       if ($validatedData['transactions_type'] == '3') {
           $transaction->update($validatedData);

           $procedure = new Procedure();
           $procedure->transaction_id = $transaction->id;
           $procedure->user_id = $user->id;
           $procedure->procedure_types_id = $validatedData['transactions_type'];
           $procedure->save();

           return redirect(route("transaction.adminshow", $transaction->id))->with(['success' => 'تم اجراء الاعتماد بنجاح']);
       } elseif ($validatedData['transactions_type'] == '2') {
           $transaction->update($validatedData);

           if (is_array($contents) && is_array($managements)) {
               for ($i = 0; $i < count($contents); $i++) {
                   $note = new Notice();
                   $note->content = $contents[$i];
                   $note->management_id = $managements[$i];
                   $note->transaction_id = $transaction->id;
                   $note->save();
               }
           }

           $procedure = new Procedure();
           $procedure->transaction_id = $transaction->id;
           $procedure->user_id = $user->id;
           $procedure->procedure_types_id = $validatedData['transactions_type'];
           $procedure->save();

           return redirect(route("transaction.adminshow", $transaction->id))->with(['success' => 'تم اجراء الرفض بنجاح']);
       } elseif ($validatedData['transactions_type'] == '4') {
           $transaction->update($validatedData);

           $procedure = new Procedure();
           $procedure->transaction_id = $transaction->id;
           $procedure->user_id = $user->id;
           $procedure->to_employee = $validatedData['to_employee'];
           $procedure->procedure_types_id = $validatedData['transactions_type'];
           $procedure->save();
       }

       return redirect(route("transaction.adminshow", $transaction->id))->with(['success' => 'تم اجراء اعادة التوجيه بنجاح']);
   }





    public function index()
    {





            $employee = Auth::guard('employee')->user();



                $transactions = DB::table('transactions')
                ->select('transactions.*')

                 ->where('transactions.to_employee', '=',  $employee->id )

                ->orderBy('transactions.created_at', 'desc')
                ->paginate(5);
            //  $queries = DB::getQueryLog();
  // ->select( function ($query) {
                //     $last_procedure->select(DB::raw('MAX(procedures2.id)'))
                //         ->from('procedures AS procedures2')
                //         ->where('procedures2.transaction_id', '=', 'procedures.transaction_id' );
                // })

                // ->where('procedures.id', '=', function ($query) {
                //     $query->select(DB::raw('MAX(id)'))
                //         ->from('procedures');
                // })
                // ->orderByDesc('procedures.id')
                // ->leftJoin('transactions', 'procedures.transaction_id', '=', 'transactions.id')
              //dd( $queries);
            //  DB::connection()->enableQueryLog();
            //   $transactions =  DB::statement("
            //     SELECT
            //     transactions.*
            //     , ( SELECT MAX(procedures2.id) FROM procedures as procedures2 WHERE procedures2.transaction_id = procedures.transaction_id ) AS 'last_procedure'
            //     , ( SELECT MAX(procedures2.id) FROM procedures as procedures2 WHERE procedures2.transaction_id = procedures.transaction_id AND procedures2.to_employee = 2 AND procedures2.procedure_types_id = 4) AS 'last_assign_procedure_for_user'
            //     FROM
            //     transactions
            //     INNER JOIN procedures ON transactions.id = procedures.transaction_id
            //     INNER JOIN procedure_types ON procedures.procedure_types_id = procedure_types.id
            //     GROUP BY
            //     transactions.id,
            //     transactions.created_at,
            //     transactions.updated_at,
            //     transactions.transactions_type,
            //     transactions.year,
            //     transactions.management_id,
            //     transactions.month,
            //     transactions.data,
            //     transactions.type,
            //     procedures.transaction_id


            //     HAVING
            //     last_procedure = last_assign_procedure_for_user
            //   ");
              //dd(DB::getQueryLog());

            //   $transactions =  DB::table('transactions')
            //   ->select('transactions.*',
            //   DB::raw('(SELECT MAX(procedures2.id) FROM procedures as procedures2 WHERE procedures2.transaction_id = procedures.transaction_id) AS last_procedure'),
            //   DB::raw('(SELECT MAX(procedures2.id) FROM procedures as procedures2 WHERE procedures2.transaction_id = procedures.transaction_id AND procedures2.to_employee = 2 AND procedures2.procedure_types_id = 4) AS last_assign_procedure_for_user')
            //     )->get();

            //   DB::raw('(SELECT MAX(procedures2.id) FROM procedures as procedures2 WHERE procedures2.transaction_id = procedures.transaction_id AND procedures2.to_employee = 2 AND procedures2.procedure_types_id = 4) AS last_assign_procedure_for_user'))
            //   ->join('procedures', 'transactions.id', '=', 'procedures.transaction_id')
            //   ->join('procedure_types', 'procedures.procedure_types_id', '=', 'procedure_types.id')
            //   ->groupBy('transactions.id')
            //   ->havingRaw('last_procedure = last_assign_procedure_for_user')
            //   ->orderBy('procedures.created_at', 'DESC')
            //   ->paginate(5);
/*
$transactions = Transaction::has('lastProcedure')
    ->has('lastAssignProcedureForUser')
    ->with(['lastProcedure', 'lastAssignProcedureForUser'])
    ->orderByDesc('lastProcedure.created_at')
    ->get();
*/
  $trans = Transaction::orderBy('created_at', 'desc')->paginate(5);

//dd( $transactions->all());

//$procedures = Procedure::all();

        return view('transaction.index', ["transactions" => $transactions , "trans" => $trans , ]);
    }
    public function create()
    {
        return view('transaction.create');
    }

    public function store(Request $request)
{
    $req = $request->validate([
        'year' => 'required',
        'management_id' => 'required',
        'month' => 'required',
        'data' => 'required',
        'type' => 'required',
        'idnum' => 'nullable|integer',
        'summary' => 'nullable|integer',
    ]);



    $employee = Auth::guard('employee')->user();

    $transaction = new Transaction($req);
    $transaction->save();

    $procedure = new Procedure();
    $procedure->transaction_id = $transaction->id;
    $procedure->employee_id = $employee->id;
    $procedure->procedure_types_id = 1;
    $procedure->save();

        return redirect(route("transaction.index"));

    }
   // public function show(transaction $transaction)
    //{
       // $transactions =  DB::table('transactions')
            //->join('employees', 'transactions.employee_id', '=', 'employees.id')
          //  ->select('employees.name AS employee_name', 'transactions.*')
           // ->where('transactions.id', $transactionId)
//->first();

         //  dd($transactions->all());
       // return view('transaction.show', ['transaction' => $transaction]);
   // }
   public function show(Transaction $transaction)
   {


    if ( Auth::guard('employee')->user()->id !== $transaction->to_employee) {
        abort(403);
    }

    $query = DB::raw('IFNULL(employees.name, users.name) AS name');
    $procedures = DB::table('procedures')
    ->leftjoin('employees', 'procedures.employee_id', '=', 'employees.id')
    ->leftjoin('users', 'procedures.user_id', '=', 'users.id')
    ->join('procedure_types', 'procedures.procedure_types_id', '=', 'procedure_types.id')
    ->leftjoin('employees AS to_employees', 'procedures.to_employee', '=', 'to_employees.id')
    ->select($query, 'procedure_types.name AS procedure_name', 'procedures.created_at AS procedure_time', 'to_employees.name AS to_name' , 'procedures.*')
    ->where('procedures.transaction_id', $transaction->id)
    ->orderByDesc('procedure_time')
    ->get();


    $employees = DB::table('employees')->get();
       return view('transaction.show', [
           'transaction' => $transaction,
           'procedures' => $procedures,
           'employees' => $employees,
       ]);
   }

    //edit




    public function edit(Transaction $transaction)
    {

        return view('transaction.show', [ 'transaction' => $transaction,]);
    }
    public function update(Request $request, Transaction $transaction)
{
    $contents = $request->input('content');
    $managements = $request->input('management_id');



    $validatedData = $request->validate([
        'transactions_type' => 'required',
        'to_employee' => 'nullable',
    ]);


    $employee = Auth::guard('employee')->user();

    if ($validatedData['transactions_type'] == '3') {
        $transaction->update($validatedData);

        $procedure = new Procedure();
        $procedure->transaction_id = $transaction->id;
        $procedure->employee_id = $employee->id;
        $procedure->procedure_types_id = $validatedData['transactions_type'];
        $procedure->save();

        return redirect(route("transaction.show", $transaction->id))->with(['success' => 'تم اجراء الاعتماد بنجاح']);
    } elseif ($validatedData['transactions_type'] == '2') {
        $transaction->update($validatedData);

        if (is_array($contents) && is_array($managements)) {
            for ($i = 0; $i < count($contents); $i++) {
                $note = new Notice();
                $note->content = $contents[$i];
                $note->management_id = $managements[$i];
                $note->transaction_id = $transaction->id;
                $note->save();
            }
        }

        $procedure = new Procedure();
        $procedure->transaction_id = $transaction->id;
        $procedure->employee_id = $employee->id;
        $procedure->procedure_types_id = $validatedData['transactions_type'];
        $procedure->save();

        return redirect(route("transaction.show", $transaction->id))->with(['success' => 'تم اجراء الرفض بنجاح']);
    } elseif ($validatedData['transactions_type'] == '4') {
        $transaction->update($validatedData);

        $procedure = new Procedure();
        $procedure->transaction_id = $transaction->id;
        $procedure->employee_id = $employee->id;
        $procedure->to_employee = $validatedData['to_employee'];
        $procedure->procedure_types_id = $validatedData['transactions_type'];
        $procedure->save();
    }

    return redirect(route("transaction.show", $transaction->id))->with(['success' => 'تم اجراء اعادة التوجيه بنجاح']);
}

public function search(Request $request)
{
    $request->validate([
        'id' => 'required'
    ]);

    $search = $request->id;

    $filterTransactions = Transaction::where('id',  $search )->paginate(5);

    return view('transaction.index', ['transactions' => $filterTransactions]);
}

public function adminsearch(Request $request)
{
    $request->validate([
        'id' => 'required'
    ]);

    $search = $request->id;

    $filterTransactions = Transaction::where('id',  $search )->paginate(5);

    return view('transaction.adminindex', ['transactions' => $filterTransactions]);
}

}

