<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class adminpeminjamancontroller extends Controller
{
    public function index(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        #WAJIB
        $pages='peminjaman';
        $jmldata='0';
        $datas='0';


        $datas=DB::table('peminjaman')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        // $peminjamankategori = DB::table('kategori')->where('prefix','tipepeminjaman')->get();
        // $kondisi = DB::table('kategori')->where('prefix','kondisi')->get();

        return view('admin.peminjaman.index',compact('pages','datas','request'));
        // return view('admin.beranda');
    }

    public function store(Request $request)
    {
        if($request->daftarbuku==null){
        return redirect()->back()->with('status','Gagal! Buku tidak ditemukan!')->with('tipe','error')->with('icon','fas fa-trash');
        }
        $bukubuku=$request->daftarbuku;
        $jml=Fungsi::periksaarray($bukubuku);
        // if()
        $str=explode(",",$bukubuku);
        for($i=0;$i<$jml;$i++){
            
            
        }
        
        $datas=DB::table('bukudetail')->where('kodepanggil',$str[0])->first();
        $dataanggota=DB::table('anggota')->where('nomeridentitas',$request->nomeridentitas)->first();


        //buat kodetransaksi dari date masukkan ke peminjaman dan peminjamandetail
        $kodetrans=base64_encode(date('YmdHis'));
        $decodekodetrans=base64_decode($kodetrans);
        dd(($str[0]),$datas,$request->nomeridentitas,$dataanggota->nama,$kodetrans,$decodekodetrans);

        //insert anggota ke peminjaman
        
        //insert buku ke peminjaman detail where kodetransaksi

        //ubah status buku per exemplar bahwa dipinjam

    }
    
    public function periksa($id)
    {
        
        $datas=DB::table('bukudetail')->where('kodepanggil',$id)->count();
        $data=DB::table('bukudetail')->where('kodepanggil',$id)->first();
        // //make response JSON
        if($datas>0){
            return response()->json([
                'success' => true,
                'message' => $datas,
                'buku_nama' => $data->buku_nama,
                'bukukategori_nama' => $data->bukukategori_nama,
                'data'    => $id  
            ], 200);

        }else{
            return response()->json([
                'success' => true,
                'message' => $datas,
                'data'    => $id  
            ], 200);

        }
    }

}
