<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/companylist', [CompaniesController::class, 'index'])->name('companylist')->middleware('auth');
Route::get('/tambahcompany', [CompaniesController::class, 'tambahcompany'])->name('tambahcompany')->middleware('auth');
Route::post('/insertcompany', [CompaniesController::class, 'insertcompany'])->name('insertcompany')->middleware('auth');
Route::get('/tampilcompany/{id}', [CompaniesController::class, 'tampilcompany'])->name('tampilcompany')->middleware('auth');
Route::post('/updatecompany/{id}', [CompaniesController::class, 'updatecompany'])->name('updatecompany')->middleware('auth');
Route::get('/deletecompany/{id}', [CompaniesController::class, 'deletecompany'])->name('deletecompany')->middleware('auth');
Route::get('/exportcompany', [CompaniesController::class, 'exportcompany'])->name('exportcompany')->middleware('auth');
Route::post('/importcompany', [CompaniesController::class, 'importcompany'])->name('importcompany')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/employeeslist', [EmployeesController::class, 'index'])->name('employeeslist')->middleware('auth');
Route::get('/tambahemployees', [EmployeesController::class, 'tambahemployees'])->name('tambahemployees')->middleware('auth');
Route::post('/insertemployees', [EmployeesController::class, 'insertemployees'])->name('insertemployees')->middleware('auth');
Route::get('/tampilemployees/{id}', [EmployeesController::class, 'tampilemployees'])->name('tampilemployees')->middleware('auth');
Route::post('/updateemployees/{id}', [EmployeesController::class, 'updateemployees'])->name('updateemployees')->middleware('auth');
Route::get('/deleteemployees/{id}', [EmployeesController::class, 'deleteemployees'])->name('deleteemployees')->middleware('auth');
Route::get('/exportemployees', [EmployeesController::class, 'exportemployees'])->name('exportemployees')->middleware('auth');
Route::post('/importemployees', [EmployeesController::class, 'importemployees'])->name('importemployees')->middleware('auth');