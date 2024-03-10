<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionController;

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

Route::get('/', [AdmissionController::class, 'index'])->name('admissions.index');
Route::post('/register', [AdmissionController::class, 'add'])->name('admissions.add');
Route::get('/admissions/delete', [AdmissionController::class, 'delete'])->name('admissions.delete');
