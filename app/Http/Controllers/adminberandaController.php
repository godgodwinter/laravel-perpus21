<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Models\tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class adminberandaController extends Controller
{
    public function index()
    {

        if(($this->checkauth('siswa')==='404')&&($this->checkauth('admin')==='404')&&($this->checkauth('kepsek')==='404')&&($this->checkauth('guru')==='404')){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        if($this->checkauth('siswa')==='success'){
            return redirect(route('siswa.tagihansiswa'));
        }

        $pages='beranda';
        $siswa = DB::table('siswa')->count();
        $kelas = DB::table('kelas')->count();
     

        return view('admin.pages.beranda',compact('pages'
            ,'kelas'
        ));
        }

    public function notfound()
    {

        return view('404');
    }
}
