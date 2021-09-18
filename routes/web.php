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
Route::get('/admin/bukurak/cari', 'App\Http\Controllers\adminbukurakcontroller@cari')->name('admin.bukurak.cari');
Route::post('/admin/bukurak', 'App\Http\Controllers\adminbukurakcontroller@store')->name('admin.bukurak.store');
Route::get('/admin/bukurak/{id}', 'App\Http\Controllers\adminbukurakcontroller@show')->name('admin.bukurak.show');
Route::put('/admin/bukurak/{id}', 'App\Http\Controllers\adminbukurakcontroller@update')->name('admin.bukurak.update');
Route::delete('/admin/bukurak/{id}', 'App\Http\Controllers\adminbukurakcontroller@destroy')->name('admin.bukurak.destroy');
Route::delete('/admin/databukurak/multidel', 'App\Http\Controllers\adminbukurakcontroller@multidel')->name('admin.bukurak.multidel');


//buku-MENU
Route::get('/admin/buku', 'App\Http\Controllers\adminbukucontroller@index')->name('admin.buku');
Route::get('/admin/buku/cari', 'App\Http\Controllers\adminbukucontroller@cari')->name('admin.buku.cari');
Route::post('/admin/buku', 'App\Http\Controllers\adminbukucontroller@store')->name('admin.buku.store');
Route::get('/admin/buku/{id}', 'App\Http\Controllers\adminbukucontroller@show')->name('admin.buku.show');
Route::put('/admin/buku/{id}', 'App\Http\Controllers\adminbukucontroller@update')->name('admin.buku.update');
Route::delete('/admin/buku/{id}', 'App\Http\Controllers\adminbukucontroller@destroy')->name('admin.buku.destroy');
Route::delete('/admin/databuku/multidel', 'App\Http\Controllers\adminbukucontroller@multidel')->name('admin.buku.multidel');


//bukudetail-MENU
Route::get('/admin/buku/{id}/bukudetail', 'App\Http\Controllers\adminbukudetailcontroller@index')->name('admin.buku.bukudetail');
Route::post('/admin/buku/{id}/bukudetail/cari', 'App\Http\Controllers\adminbukudetailcontroller@cari')->name('admin.bukudetail.cari');
Route::post('/admin/buku/{id}/bukudetail', 'App\Http\Controllers\adminbukudetailcontroller@store')->name('admin.bukudetail.store');
Route::get('/admin/buku/{buku}/bukudetail/{id}', 'App\Http\Controllers\adminbukudetailcontroller@show')->name('admin.bukudetail.show');
Route::put('/admin/buku/{buku}/bukudetail/{id}', 'App\Http\Controllers\adminbukudetailcontroller@update')->name('admin.bukudetail.update');
Route::delete('/admin/buku/{buku}/bukudetail/{id}', 'App\Http\Controllers\adminbukudetailcontroller@destroy')->name('admin.bukudetail.destroy');
Route::delete('/admin/bukudetail/multidel', 'App\Http\Controllers\adminbukudetailcontroller@multidel')->name('admin.bukudetail.multidel');


//anggota-MENU
Route::get('/admin/anggota', 'App\Http\Controllers\adminanggotacontroller@index')->name('admin.anggota');
Route::get('/admin/anggota/cari', 'App\Http\Controllers\adminanggotacontroller@cari')->name('admin.anggota.cari');
Route::post('/admin/anggota', 'App\Http\Controllers\adminanggotacontroller@store')->name('admin.anggota.store');
Route::get('/admin/anggota/{id}', 'App\Http\Controllers\adminanggotacontroller@show')->name('admin.anggota.show');
Route::put('/admin/anggota/{id}', 'App\Http\Controllers\adminanggotacontroller@update')->name('admin.anggota.update');
Route::delete('/admin/anggota/{id}', 'App\Http\Controllers\adminanggotacontroller@destroy')->name('admin.anggota.destroy');
Route::delete('/admin/dataanggota/multidel', 'App\Http\Controllers\adminanggotacontroller@multidel')->name('admin.anggota.multidel');


//SETTINGS-MENU
Route::get('/admin/settings', 'App\Http\Controllers\settingsController@index')->name('admin.settings');
Route::put('/admin/settings/{id}', 'App\Http\Controllers\settingsController@update')->name('admin.settings.update');

// ExportdanImport
Route::get('admin/databukurak/export', 'App\Http\Controllers\prosesController@exportbukurak')->name('bukurak.export');
Route::post('admin/databukurak/import', 'App\Http\Controllers\prosesController@importbukurak')->name('bukurak.import');
Route::get('admin/databuku/export', 'App\Http\Controllers\prosesController@exportbuku')->name('buku.export');
Route::post('admin/databuku/import', 'App\Http\Controllers\prosesController@importbuku')->name('buku.import');
Route::get('admin/databukudetail/export', 'App\Http\Controllers\prosesController@exportbukudetail')->name('bukudetail.export');
Route::post('admin/databukudetail/import', 'App\Http\Controllers\prosesController@importbukudetail')->name('bukudetail.import');
Route::get('admin/dataanggota/export', 'App\Http\Controllers\prosesController@exportanggota')->name('anggota.export');
Route::post('admin/dataanggota/import', 'App\Http\Controllers\prosesController@importanggota')->name('anggota.import');

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
