<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class adminanggotacontroller extends Controller
{
    public function index(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }

        #WAJIB
        $pages='anggota';
        $jmldata='0';
        $datas='0';


        $datas=DB::table('anggota')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        // $anggotakategori = DB::table('kategori')->where('prefix','ddc')->get();

        return view('admin.anggota.index',compact('pages','datas','request'));
        // return view('admin.beranda');
    }
    public function store(Request $request)
    {
        // dd($request);
        // dd($request);
        $request->validate([
            'nama'=>'required|unique:anggota,nama',
            'tipe'=>'required',
            'nomeridentitas'=>'unique:anggota,nomeridentitas',
            'tempatlahir'=>'required',
            'tgllahir'=>'required',
            'jk'=>'required',
            'agama'=>'required',
            'alamat'=>'required',
            'sekolahasal'=>'required',


        ],
        [
            'nama.required'=>'Nama Harus diisi',

        ]);
        
       DB::table('anggota')->insert(
        array(
               'nama'     =>   $request->nama,
               'tipe'     =>   $request->tipe,
               'nomeridentitas'     =>   $request->nomeridentitas,
               'tempatlahir'     =>   $request->tempatlahir,
               'tgllahir'     =>   $request->tgllahir,
               'jk'     =>   $request->jk,
               'agama'     =>   $request->agama,
               'alamat'     =>   $request->alamat,
               'sekolahasal'     =>   $request->sekolahasal,
               'telp'     =>   $request->telp,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        ));

        return redirect()->back()->with('status','Data berhasil di tambahkan!')->with('tipe','success');
    
    }
    public function show(Request $request,anggota $id)
    {
        // dd($id);
        #WAJIB
        $pages='anggota';
        $datas=$id;
        

        return view('admin.anggota.edit',compact('pages','datas','request'));
    }
    public function proses_update($request,$datas)
    {
        if($request->nomeridentitas!==$datas->nomeridentitas){
            $request->validate([
                'nomeridentitas'=>'unique:anggota,nomeridentitas'
            ],
            [
                'nomeridentitas.unique'=>'Identitas sudah digunakan'


            ]);
        }
    

       
        anggota::where('id',$datas->id)
        ->update([
            'nama'     =>   $request->nama,
            'tipe'     =>   $request->tipe,
            'nomeridentitas'     =>   $request->nomeridentitas,
            'tempatlahir'     =>   $request->tempatlahir,
            'tgllahir'     =>   $request->tgllahir,
            'jk'     =>   $request->jk,
            'agama'     =>   $request->agama,
            'alamat'     =>   $request->alamat,
            'sekolahasal'     =>   $request->sekolahasal,
            'telp'     =>   $request->telp,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);

        
    }

    public function update(Request $request, anggota $id)
    {
        $this->proses_update($request,$id);

            return redirect()->back()->with('status','Data berhasil diupdate!')->with('tipe','success')->with('icon','fas fa-edit');
    }
    
    public function destroy($id)
    {
        anggota::destroy($id);
        return redirect()->back()->with('status','Data berhasil dihapus!')->with('tipe','info')->with('icon','fas fa-trash');
    
    }

    public function multidel(Request $request)
    {
        
        $ids=$request->ids;

        // $datasiswa = DB::table('siswa')->where('id',$ids)->get();
        // foreach($datasiswa as $ds){
        //     $nis=$ds->nis;
        // }

        // dd($request);

        // DB::table('tagihansiswa')->where('siswa_nis', $ids)->where('tapel_nama',$this->tapelaktif())->delete();
        anggota::whereIn('id',$ids)->delete();

        
        // load ulang
     
        #WAJIB
        $pages='anggota';
        $jmldata='0';
        $datas='0';


        $datas=DB::table('anggota')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        // $anggotakategori = DB::table('kategori')->where('prefix','ddc')->get();

        return view('admin.anggota.index',compact('pages','datas','request'));

    }
}
