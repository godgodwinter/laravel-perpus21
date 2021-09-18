<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class adminbukucontroller extends Controller
{
    public function index(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        #WAJIB
        $pages='buku';
        $jmldata='0';
        $datas='0';


        $datas=DB::table('buku')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        $bukurak = DB::table('bukurak')->get();
        $bukukategori = DB::table('kategori')->where('prefix','ddc')->get();

        return view('admin.buku.index',compact('pages','bukurak','bukukategori','datas','request'));
        // return view('admin.beranda');
    }
    
    public function store(Request $request)
    {
        // dd($request);
        // dd($request);
        $request->validate([
            'nama'=>'required|unique:bukurak,nama',
            'bukurak_nama'=>'required',
            'bukukategori_nama'=>'required',


        ],
        [
            'nama.required'=>'Nama Harus diisi',

        ]);
        
        $ambilbukurak_kode = DB::table('bukurak')->where('nama',$request->bukurak_nama)->first();
        $ambilbukukategori_ddc = DB::table('kategori')->where('nama',$request->bukukategori_nama)->first();

        $kodebuku=Fungsi::autokodebuku($ambilbukukategori_ddc->kode);
        if($kodebuku==='penuh'){
            return redirect()->back()->with('status','Data Gagal di tambahkan karena kode buku penuh!')->with('tipe','error')->with('icon','fas fa-feather');

        }
        // dd($kodebuku);
       DB::table('buku')->insert(
        array(
               'nama'     =>   $request->nama,
               'kode'     =>   $kodebuku,
               'bukurak_nama'     =>   $request->bukurak_nama,
               'bukurak_kode'     =>   $ambilbukurak_kode->kode,
               'bukukategori_nama'     =>   $request->bukukategori_nama,
               'bukukategori_ddc'     =>   $ambilbukukategori_ddc->kode,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        ));

        $notification = array(
            'message' => 'Post created successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with('status','Data berhasil di tambahkan!')->with('tipe','success');
    
    }
}
