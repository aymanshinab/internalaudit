<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\empProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\EmployeeController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/admin/employees' , [EmployeeController::class, 'index'])->name('employee.index');

    Route::get('/admin/employees/{employee}/edit' , [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::patch('/admin/employees/{employee}/edit' , [EmployeeController::class, 'update'])->name('employee.update');

    Route::get('/admin/transaction' , [TransactionController::class, 'adminindex'])->name('transaction.adminindex');
    Route::get('/admin/transaction/{transaction}/show' , [TransactionController::class, 'adminshow'])->name('transaction.adminshow');
    Route::get('/admin/transaction/{transaction}/update' , [TransactionController::class, 'adminedit'])->name('transaction.adminedit');

    Route::get('/admin/transaction/create' , [TransactionController::class, 'admincreate'])->name('transaction.admincreate');

    Route::post('/admin/transaction/create' , [TransactionController::class, 'adminstore'])->name('transaction.adminstore');

    Route::post('/admin/transaction/search', [TransactionController::class, 'adminsearch'])->name('transaction.adminsearch');

    Route::patch('/admin/transaction/{transaction}/update' , [TransactionController::class, 'adminupdate'])->name('transaction.adminupdate');
    Route::get('/admin/transaction/{transaction}/notice/show' , [NoticeController::class, 'adminshow'])->name('notice.adminshow');


});
require __DIR__.'/auth.php';

Route::get('/employee/dashboard', function () {
    return view('employee.dashboard');
})->middleware(['auth:employee', 'verified'])->name('employee.dashboard');

Route::middleware('auth:employee')->group(function () {


    Route::get('/employee/profile', [empProfileController::class, 'empedit'])->name('empprofile.edit');
    Route::patch('/employee/profile', [empProfileController::class, 'empupdate'])->name('empprofile.update');


Route::get('/employee/transaction' , [TransactionController::class, 'index'])->name('transaction.index');

    Route::get('/employee/transaction/create' , [TransactionController::class, 'create'])->name('transaction.create');

    Route::post('/employee/transaction/create' , [TransactionController::class, 'store'])->name('transaction.store');

    Route::get('/employee/transaction/{transaction}/show' , [TransactionController::class, 'show'])->name('transaction.show');

    Route::get('/employee/transaction/{transaction}/notice/show' , [NoticeController::class, 'show'])->name('notice.show');

    Route::get('/employee/transaction/{transaction}/update' , [TransactionController::class, 'edit'])->name('transaction.edit');

    Route::patch('/employee/transaction/{transaction}/update' , [TransactionController::class, 'update'])->name('transaction.update');

    Route::post('/employee/transaction/search', [TransactionController::class, 'search'])->name('transaction.search');

});

require __DIR__.'/employeeauth.php';




