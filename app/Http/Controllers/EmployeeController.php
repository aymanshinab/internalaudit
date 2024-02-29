<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
class EmployeeController extends Controller
{

    public function index()
    {

  $employees = Employee::orderBy('created_at', 'desc')->paginate(5);

//dd( $employees->all());


        return view('emp.index', ["employees" => $employees   ]);
    }



    public function edit( Employee $employee)
    {

        return view('emp.edit', [ 'employee' => $employee,]);
    }
    public function update(Request $request, Employee $employee)
{

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
         'phone_number' => 'required|digits_between:10,10|numeric|starts_with:091,092,094,021 ',
         'role' => ['required', 'integer', ],
         'email' => ['required', 'string', 'lowercase', 'email', 'max:255',],
         'password' => ['required', 'confirmed', Rules\Password::defaults()],
     ]);

     $employee->update([
        'name' => $request->name,
        'phone_number' => $request->phone_number,
        'role' => $request->role,
        'email' => $request->email,
        'password' => Hash::make($request->password),
     ]);

return redirect(route('employee.index'))->with(['success' => 'تم تعديل الموظف بنجاح']);





}

}
