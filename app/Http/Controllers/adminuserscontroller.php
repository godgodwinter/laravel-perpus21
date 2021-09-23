<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class adminuserscontroller extends Controller
{
    public function index(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        #WAJIB
        $pages='users';
        $jmldata='0';
        $datas='0';


        $datas=DB::table('users')
        ->orderBy('name','asc')
        ->paginate(Fungsi::paginationjml());

        // $userskategori = DB::table('kategori')->where('prefix','ddc')->get();

        return view('admin.users.index',compact('pages','datas','request'));
        // return view('admin.beranda');
    }
    
    public function cari(Request $request)
    {
        // dd($request);
        $cari=$request->cari;

        #WAJIB
        $pages='users';
        $jmldata='0';
        $datas='0';


    $datas=DB::table('users')
    // ->where('nis','like',"%".$cari."%")
    ->where('name','like',"%".$cari."%")
    ->orWhere('nomeridentitas','like',"%".$cari."%")
    ->orWhere('agama','like',"%".$cari."%")
    ->orWhere('tipe','like',"%".$cari."%")
    ->paginate(Fungsi::paginationjml());



    // $bukurak = DB::table('bukurak')->get();
    // $bukukategori = DB::table('kategori')->where('prefix','ddc')->get();

    return view('admin.users.index',compact('pages','datas','request'));
    }
}
