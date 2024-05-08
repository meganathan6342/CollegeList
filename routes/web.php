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

//college
Route::get('/', CollegesController::class.'@index')->name('index');
Route::post('/submit-clg', CollegesController::class.'@store')->name('submit.clg');
Route::get('/edit-clg', CollegesController::class.'@edit')->name('clg.form');
Route::put('/update-clg/{id}', CollegesController::class.'@update')->name('update.clg');
Route::get('/delete-clg', CollegesController::class.'@delete')->name('delete.clg');
Route::get('/search-clg', CollegesController::class.'@search')->name('search.clg');

//depts
Route::get('/depts/{id}', DepartmentsController::class.'@index')->name('dept.details');
Route::post('/submit-dept', DepartmentsController::class.'@store')->name('submit.dept');
Route::get('/edit-dept', DepartmentsController::class.'@edit')->name('dept.form');
Route::put('/update-dept/{id}', DepartmentsController::class.'@update')->name('update.dept');
Route::get('/delete-dept', DepartmentsController::class.'@delete')->name('delete.dept');
Route::get('/search-dept', DepartmentsController::class.'@search')->name('search.dept');

//staff
Route::get('/staffs/{id}', StaffsController::class.'@index')->name('staff.details');
Route::post('/submit-staff', StaffsController::class.'@store')->name('submit.staff');
Route::get('/edit-staff', StaffsController::class.'@edit')->name('staff.form');
Route::put('/update-staff/{id}', StaffsController::class.'@update')->name('update.staff');
Route::get('/delete-staff', StaffsController::class.'@delete')->name('delete.staff');
Route::get('/search-staff', StaffsController::class.'@search')->name('search.staff');

//students
Route::get('/students/{id}', StudentsController::class.'@index')->name('student.details');
Route::post('/submit-student', StudentsController::class.'@store')->name('submit.student');
Route::get('/edit-student', StudentsController::class.'@edit')->name('student.form');
Route::put('/update-student/{id}', StudentsController::class.'@update')->name('update.student');
Route::get('/delete-student', StudentsController::class.'@delete')->name('delete.student');
Route::get('/search-student', StudentsController::class.'@search')->name('search.student');