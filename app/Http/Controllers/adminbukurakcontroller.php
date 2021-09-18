<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Fungsi;

class adminbukurakcontroller extends Controller
{
    public function index(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        #WAJIB
        $pages='bukurak';
        $jmldata='0';
        $datas='0';


        $datas=DB::table('bukurak')
        ->paginate(Fungsi::paginationjml());

        $jmldata = DB::table('bukurak')->count();

        return view('admin.bukurak.index',compact('pages','jmldata','datas','request'));
        // return view('admin.beranda');
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama'=>'required|unique:bukurak,nama',
            'kode'=>'required|unique:bukurak,kode'

        ],
        [
            'nama.required'=>'Nama Harus diisi',

        ]);

       DB::table('bukurak')->insert(
        array(
               'nama'     =>   $request->nama,
               'kode'     =>   $request->kode,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        ));

        return redirect()->back()->with('status','Data berhasil di tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');
    
    }
    public function show(Request $request,bukurak $id)
    {
        #WAJIB
        $pages='siswa';
        $datas='0';


        $datas=siswa::all();
        $datausers = DB::table('users')->where('nomerinduk',$siswa->nis)->get();

        return view('admin.siswa.edit',compact('pages','datas','tapel','kelas','siswa','datausers','request'));
    }
}
