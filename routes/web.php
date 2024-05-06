<?php

use App\Http\Controllers\CollegesController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\StaffsController;
use App\Http\Controllers\StudentsController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

//college
Route::get('/', CollegesController::class.'@index')->name('index');
Route::get('/college-form', function() { return view('CollegesForm'); })->name('colleges');
Route::post('/submit-college', CollegesController::class.'@store')->name('submit.clg');
Route::get('/home', CollegesController::class.'@index')->name('home.colleges');
Route::get('/delete-colleges', CollegesController::class.'@deleteColleges')->name('delete.colleges');
Route::get('/edit-college', CollegesController::class.'@updateClgForm')->name('clg.form');
Route::put('/update-college/{id}', CollegesController::class.'@updateCollege')->name('editing.college');
Route::get('/search-clg', CollegesController::class.'@search')->name('search.clg');

//depts
Route::get('/dept-details/{id}', DepartmentsController::class.'@index')->name('dept.details');
Route::post('dept-form/submit-dept', DepartmentsController::class.'@store')->name('submit.dept');
Route::get('/delete-depts', DepartmentsController::class.'@deleteDepartments')->name('delete.depts');
Route::get('/dept-update', DepartmentsController::class.'@updateDeptForm')->name('dept.form');
Route::put('/update-dept/{id}', DepartmentsController::class.'@updateDepartment')->name('editing.dept');

//staff
Route::get('/staffs-details/{id}', StaffsController::class.'@index')->name('staffs.details');
Route::post('/submit-staff', StaffsController::class.'@store')->name('submit.staff');
Route::get('/delete-staffs', StaffsController::class.'@deleteStaffs')->name('delete.staffs');
Route::get('/edit-staff', StaffsController::class.'@updateStfForm')->name('staff.form');
Route::put('/update-staff/{id}', StaffsController::class.'@updateStaff')->name('editing.staff');

//students
Route::get('/students-details/{id}', StudentsController::class.'@index')->name('students.details');
Route::post('students-form/submit-student', StudentsController::class.'@store')->name('submit.student');
Route::get('/delete-students', StudentsController::class.'@deleteStudents')->name('delete.students');
Route::get('/edit-student', StudentsController::class.'@updateStdForm')->name('student.form');
Route::put('/update-student/{id}', StudentsController::class.'@updateStudent')->name('editing.student');