<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','Blade'])
->group(function () {

    Route::get('/app/dashboard', 'admin\DashboardController@index')->name('dashboard');


  /*   $role = Auth::user()->role;
    session()->put('role',strtolower($role));
    if($role->id != 3){
        return redirect()->back()->with(['errors_' => [__('msg.access_deny')]]);  
    }else{
        return redirect(route('dashboard'));
    } */

    #company
    Route::get('company','company\CompanyController@index')->name('company');
    Route::post('company-save/{id?}','company\CompanyController@save')->name('company.save');
    Route::get('company-datatable', 'company\CompanyController@datatable')->name('company.datatable');
    Route::get('company/edit/{id}', 'company\CompanyController@edit')->name('company.edit');
    Route::get('company/block/{id}', 'company\CompanyController@block')->name('company.block');
    Route::get('company/unblock/{id}', 'company\CompanyController@unblock')->name('company.unblock');
    
    #new requested employee
    Route::get('requested-employee','admin\requestedEmployee\RequestedEmployeeController@index')->name('requested.employee');
    Route::get('requested-employee-datatable','admin\requestedEmployee\RequestedEmployeeController@datatable')->name('requested.employee.datatable');
    Route::get('requested-employee-accept/{id}', 'admin\requestedEmployee\RequestedEmployeeController@accept')->name('requested.employee.accept');
    Route::get('requested-employee-reject/{id}', 'admin\requestedEmployee\RequestedEmployeeController@reject')->name('requested.employee.reject');

    #Department
    Route::get('departments', 'employee\DepartmentController@index')->name('departments');
    Route::get('departments-datatable', 'employee\DepartmentController@datatable')->name('department.datatable');
    Route::post('save-department/{id?}', 'employee\DepartmentController@save')->name('department.save');
    Route::get('department-edit/{id}', 'employee\DepartmentController@edit')->name('department.edit');
    Route::get('block-department/{id}', 'employee\DepartmentController@block')->name('department.block');
    Route::get('unblock-department/{id}', 'employee\DepartmentController@unblock')->name('department.unblock');
    
    #Designation
    Route::get('designations', 'employee\DesignationController@index')->name('designations');
    Route::get('designations-datatable', 'employee\DesignationController@datatable')->name('designation.datatable');
    Route::post('save-designation/{id?}', 'employee\DesignationController@save')->name('designation.save');
    Route::get('designation-edit/{id}', 'employee\DesignationController@edit')->name('designation.edit');
    Route::get('block-designation/{id}', 'employee\DesignationController@block')->name('designation.block');
    Route::get('unblock-designation/{id}', 'employee\DesignationController@unblock')->name('designation.unblock');
    
    #Employees
    Route::get('employee-list', 'employee\EmployeeController@index')->name('employee-list');
    Route::get('employees-datatable', 'employee\EmployeeController@datatable')->name('employee.datatable');
    Route::post('save-employee/{id?}', 'employee\EmployeeController@save')->name('employee.save');
    Route::post('save-employee-history', 'employee\EmployeeController@store_history')->name('employee.history.save');
    Route::get('employee-edit/{id}', 'employee\EmployeeController@edit')->name('employee.edit');
    Route::get('block-employee/{id}', 'employee\EmployeeController@block')->name('employee.block');
    Route::get('unblock-employee/{id}', 'employee\EmployeeController@unblock')->name('employee.unblock');
    
    #attendance 
    Route::get('get-attendance-sheet', 'employee\AttendanceController@index')->name('attendance-sheet');
    Route::get('members-lista', 'employee\AttendanceController@index')->name('requested.members');
    Route::get('attendance-datatable', 'employee\AttendanceController@datatable')->name('attendance.datatable');
    Route::post('save-attendance/{id?}', 'employee\AttendanceController@save')->name('attendance.save');
    Route::get('attendance-edit/{id}', 'employee\AttendanceController@edit')->name('attendance.edit');
    Route::get('block-attendance/{id}', 'employee\AttendanceController@block')->name('attendance.block');
    Route::get('unblock-attendance/{id}', 'employee\AttendanceController@unblock')->name('attendance.unblock');
    

    Route::get('/branch', function () {
        return "branch";
    })->name('branch');

    Route::get('/branch-counter', function () {
        return "Branch counter";
    })->name('branch-counter');
    Route::get('/company-profile', function () {
        return "branch";
    })->name('company-profile');
    Route::get('/roles', function () {
        return "branch";
    })->name('roles');
    Route::get('/users', function () {
        return "branch";
    })->name('users');
});
