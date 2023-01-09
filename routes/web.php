<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\IdCardController;

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
    return redirect('/admin');
    //  route('admin');
    // return view('welcome');
});
Route::get('/confirm_info/{id}', [ConfirmController::class,'index'])->name('confrim_info_link');
Route::post('/save', [ConfirmController::class,'save'])->name('confrim_info');
Route::get('/test', [ConfirmController::class,'test'])->name('t');
Route::get('/notify', [IdCardController::class,'notify'])->name('notify');
Route::post('/send_noify', [IdCardController::class,'send_noify'])->name('send_noify');

Route::get('/print_id/{id}', [IdCardController::class,'print_id'])->name('print_id');
//Route::get('/test_print/{id}', [IdCardController::class,'test_print'])->name('print_id');
