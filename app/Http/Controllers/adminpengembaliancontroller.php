<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class adminpengembaliancontroller extends Controller
{
    public function index(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        #WAJIB
        $pages='pengembalian';
        $jmldata='0';
        $datas='0';


        $datas=DB::table('pengembalian')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        // $pengembaliankategori = DB::table('kategori')->where('prefix','tipepengembalian')->get();
        // $kondisi = DB::table('kategori')->where('prefix','kondisi')->get();

        return view('admin.pengembalian.index',compact('pages','datas','request'));
        // return view('admin.beranda');
    }
}
