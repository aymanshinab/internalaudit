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


    $messages = [
        'required' => "*هذا الحقل مطلوب.",
        'digits_between' => ' رقم الهاتف يجب أن يكون مكون من تسعة أرقام.',
        'starts_with' => ' رقم الهاتف يجب أن يبدأ بـ 91, 92, 94, 21.',
        'email.unique' => '    البريد الالكتروني مستعمل.',
        'phone_number.unique' => '     رقم الهاتف مستعمل.',
        'password' => 'يجب أن يتكون حقل كلمة المرور من 8 أحرف على الأقل  .',

    ];


    $request->validate([
        'name' => ['required', 'string', 'max:255'],
         'phone_number' => 'required|digits_between:9,9|numeric|starts_with:91,92,94,21 ',
         'role' => ['required', 'integer', ],
         'email' => ['required', 'string', 'lowercase', 'email', 'max:255',],

    ],  $messages);

     $employee->update([
        'name' => $request->name,
        'phone_number' => $request->phone_number,
        'role' => $request->role,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'password' => $request->password ? Hash::make($request->password) : $employee->password,
     ]);

return redirect(route('employee.index'))->with(['success' => 'تم تعديل الموظف بنجاح']);





}
public function passupdate(Request $request, Employee $employee)
{

    $messages = [

        'password' => '  يجب أن يتكون حقل كلمة المرور من 8 أحرف على الأقل وان يكون متطابق .',

    ];

    $request->validate([
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
     ],  $messages );

     $employee->update([

        'password' => Hash::make($request->password),
     ]);

return redirect(route('employee.index'))->with(['success' => 'تم تعديل الموظف بنجاح']);





}
}
