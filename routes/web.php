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
// Route::get('/dashboard', 'App\Http\Controllers\adminberandaController@index')->name('dashboard');
// Route::get('/qrtests', function()

//BUKURAK-MENU
// Route::get('/admin/bukurak', 'App\Http\Controllers\adminbukurakcontroller@index')->name('admin.bukurak');
// Route::get('/admin/bukurak/cari', 'App\Http\Controllers\adminbukurakcontroller@cari')->name('admin.bukurak.cari');
// Route::post('/admin/bukurak', 'App\Http\Controllers\adminbukurakcontroller@store')->name('admin.bukurak.store');
// Route::get('/admin/bukurak/{id}', 'App\Http\Controllers\adminbukurakcontroller@show')->name('admin.bukurak.show');
// Route::put('/admin/bukurak/{id}', 'App\Http\Controllers\adminbukurakcontroller@update')->name('admin.bukurak.update');
// Route::delete('/admin/bukurak/{id}', 'App\Http\Controllers\adminbukurakcontroller@destroy')->name('admin.bukurak.destroy');
// Route::delete('/admin/databukurak/multidel', 'App\Http\Controllers\adminbukurakcontroller@multidel')->name('admin.bukurak.multidel');


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




//peralatan-MENU
Route::get('/admin/peralatan', 'App\Http\Controllers\adminperalatancontroller@index')->name('admin.peralatan');
Route::get('/admin/peralatan/cari', 'App\Http\Controllers\adminperalatancontroller@cari')->name('admin.peralatan.cari');
Route::post('/admin/peralatan', 'App\Http\Controllers\adminperalatancontroller@store')->name('admin.peralatan.store');
Route::get('/admin/peralatan/{id}', 'App\Http\Controllers\adminperalatancontroller@show')->name('admin.peralatan.show');
Route::put('/admin/peralatan/{id}', 'App\Http\Controllers\adminperalatancontroller@update')->name('admin.peralatan.update');
Route::delete('/admin/peralatan/{id}', 'App\Http\Controllers\adminperalatancontroller@destroy')->name('admin.peralatan.destroy');
Route::delete('/admin/dataperalatan/multidel', 'App\Http\Controllers\adminperalatancontroller@multidel')->name('admin.peralatan.multidel');


//peminjaman-MENU
Route::get('/admin/peminjaman', 'App\Http\Controllers\adminpeminjamancontroller@index')->name('admin.peminjaman');
Route::get('/admin/pinjambuku', 'App\Http\Controllers\adminpeminjamancontroller@buku')->name('admin.peminjaman.buku');
Route::get('/admin/peminjaman/cari', 'App\Http\Controllers\adminpeminjamancontroller@cari')->name('admin.peminjaman.cari');
Route::post('/admin/peminjaman', 'App\Http\Controllers\adminpeminjamancontroller@store')->name('admin.peminjaman.store');
Route::get('/admin/peminjaman/periksa/{id}', 'App\Http\Controllers\adminpeminjamancontroller@periksa')->name('admin.peminjaman.periksa');
Route::get('/admin/peminjaman/periksabuku/{id}', 'App\Http\Controllers\adminpeminjamancontroller@periksabuku')->name('admin.peminjaman.periksabuku');
Route::get('/admin/bukupinjam', 'App\Http\Controllers\adminpeminjamancontroller@indexbukupinjam')->name('admin.bukupinjam');
Route::get('/admin/bukupinjam/cari', 'App\Http\Controllers\adminpeminjamancontroller@caribukupinjam')->name('admin.bukupinjam.cari');
Route::get('/admin/bukupinjam/{id}/bukudetail', 'App\Http\Controllers\adminpeminjamancontroller@indexbukupinjamdetail')->name('admin.bukupinjam.bukudetail');
Route::post('/admin/bukupinjam/{id}/bukudetail/cari', 'App\Http\Controllers\adminpeminjamancontroller@caribukupinjamdetail')->name('admin.bukupinjam.bukudetail.cari');


//peminjaman-MENU
Route::get('/admin/pengembalian', 'App\Http\Controllers\adminpengembaliancontroller@index')->name('admin.pengembalian');
Route::get('/admin/pengembalian/periksa/{id}', 'App\Http\Controllers\adminpengembaliancontroller@periksa')->name('admin.pengembalian.periksa');
Route::get('/admin/pengembalian/periksaanggota/{id}', 'App\Http\Controllers\adminpengembaliancontroller@periksaanggota')->name('admin.pengembalian.periksaanggota');
Route::get('/admin/kembalikanbuku', 'App\Http\Controllers\adminpeminjamancontroller@buku')->name('admin.kembalikan.buku');
Route::get('/admin/pengembalian/cari', 'App\Http\Controllers\adminpengembaliancontroller@cari')->name('admin.pengembalian.cari');
Route::post('/admin/pengembalian', 'App\Http\Controllers\adminpengembaliancontroller@store')->name('admin.pengembalian.store');
Route::get('/admin/pengembalian/periksa/{id}', 'App\Http\Controllers\adminpengembaliancontroller@periksa')->name('admin.pengembalian.periksa');
Route::get('/admin/bukukembali', 'App\Http\Controllers\adminpeminjamancontroller@indexbukukembali')->name('admin.bukukembali');
Route::get('/admin/bukukembali/cari', 'App\Http\Controllers\adminpeminjamancontroller@caribukukembali')->name('admin.bukukembali.cari');
Route::get('/admin/bukukembali/{id}/bukudetail', 'App\Http\Controllers\adminpeminjamancontroller@indexbukukembalidetail')->name('admin.bukukembali.bukudetail');
Route::post('/admin/bukukembali/{id}/bukudetail/cari', 'App\Http\Controllers\adminpeminjamancontroller@caribukukembalidetail')->name('admin.bukukembali.bukudetail.cari');



//SETTINGS-MENU
Route::get('/admin/settings', 'App\Http\Controllers\settingsController@index')->name('admin.settings');
Route::put('/admin/settings/{id}', 'App\Http\Controllers\settingsController@update')->name('admin.settings.update');
Route::post('admin/reset/hard', 'App\Http\Controllers\settingsController@hard')->name('reset.hard');
Route::post('admin/reset/default', 'App\Http\Controllers\settingsController@default')->name('reset.default');
Route::post('admin/seeder/anggota', 'App\Http\Controllers\settingsController@anggota')->name('seeder.anggota');
// Route::post('admin/seeder/bukurak', 'App\Http\Controllers\settingsController@bukurak')->name('seeder.bukurak');
Route::post('admin/seeder/buku', 'App\Http\Controllers\settingsController@buku')->name('seeder.buku');
Route::post('admin/seeder/bukudetail', 'App\Http\Controllers\settingsController@bukudetail')->name('seeder.bukudetail');

// ExportdanImport
Route::get('admin/databukurak/export', 'App\Http\Controllers\prosesController@exportbukurak')->name('bukurak.export');
Route::post('admin/databukurak/import', 'App\Http\Controllers\prosesController@importbukurak')->name('bukurak.import');
Route::get('admin/databuku/export', 'App\Http\Controllers\prosesController@exportbuku')->name('buku.export');
Route::post('admin/databuku/import', 'App\Http\Controllers\prosesController@importbuku')->name('buku.import');
Route::get('admin/databukudetail/export', 'App\Http\Controllers\prosesController@exportbukudetail')->name('bukudetail.export');
Route::post('admin/databukudetail/import', 'App\Http\Controllers\prosesController@importbukudetail')->name('bukudetail.import');
Route::get('admin/dataanggota/export', 'App\Http\Controllers\prosesController@exportanggota')->name('anggota.export');
Route::post('admin/dataanggota/import', 'App\Http\Controllers\prosesController@importanggota')->name('anggota.import');
Route::get('admin/dataperalatan/export', 'App\Http\Controllers\prosesController@exportperalatan')->name('peralatan.export');
Route::post('admin/dataperalatan/import', 'App\Http\Controllers\prosesController@importperalatan')->name('peralatan.import');
Route::get('admin/datapeminjaman/export', 'App\Http\Controllers\prosesController@exportpeminjaman')->name('peminjaman.export');
Route::post('admin/datapeminjaman/import', 'App\Http\Controllers\prosesController@importpeminjaman')->name('peminjaman.import');
Route::get('admin/datapengembalian/export', 'App\Http\Controllers\prosesController@exportpengembalian')->name('pengembalian.export');
Route::post('admin/datapengembalian/import', 'App\Http\Controllers\prosesController@importpengembalian')->name('pengembalian.import');

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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/', 'App\Http\Controllers\adminberandaController@notfound')->name('luar');
// Route::get('/', function()
// {
// 	return QrCode::size(250)
// 	->backgroundColor(255, 255, 204)
// 	->generate(url('/qrtests'));
// });
