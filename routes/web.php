<?php

use App\Helpers\Fungsi;
use App\Http\Controllers\pagesController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

// Route::get('/', function () {
//     return view('landing');
// });


//halaman admin fixed
Route::group(['middleware' => ['auth:web', 'verified']], function() {

//DASHBOARD-MENU
Route::get('/dashboard', 'App\Http\Controllers\adminberandaController@index')->name('dashboard');
// Route::get('/qrtests', function()

//BUKURAK-MENU
Route::get('/admin/bukurak', 'App\Http\Controllers\adminbukurakcontroller@index')->name('admin.bukurak');
Route::post('/admin/bukurak', 'App\Http\Controllers\adminbukurakcontroller@store')->name('admin.bukurak.store');
Route::delete('/admin/bukurakmultidel', 'App\Http\Controllers\adminbukurakcontroller@multidel')->name('admin.bukurak.multidel');

Route::get('admin/testing/qr', 'App\Http\Controllers\laporanController@qr')->name('testing.qr');

Route::get('/barcode', [pagesController::class, 'barcode'])->name('barcode.index');

Route::get('/register', 'App\Http\Controllers\adminberandaController@notfound')->name('cleartemp');

// Route::post('/checkemail',['uses'=>'PagesController@checkEmail']);
// Route::post('/checkemail', 'App\Http\Controllers\PagesController@checkEmail')->name('checkEmail');
// Route::get('/home', function () {
//     return view('guess/home');
// });

});

// SIAKAD-MENU-raport
Route::get('raport', 'App\Http\Controllers\raportcontroller@index')->name('raport');
Route::get('raport/{nis}', 'App\Http\Controllers\raportcontroller@show')->name('raport.show');
Route::get('raport/{nis}/cetak', 'App\Http\Controllers\raportcontroller@cetak')->name('raport.cetak');

Route::get('/404', 'App\Http\Controllers\adminberandaController@notfound');
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
Route::get('/', function()
{
	return QrCode::size(250)
	->backgroundColor(255, 255, 204)
	->generate(url('/qrtests'));
});
