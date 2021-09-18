<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\buku;
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
    
    
    public function cari(Request $request)
    {
        // dd($request);
        $cari=$request->cari;

        #WAJIB
        $pages='buku';
        $jmldata='0';
        $datas='0';


    $datas=DB::table('buku')
    // ->where('nis','like',"%".$cari."%")
    ->where('nama','like',"%".$cari."%")
    ->orWhere('kode','like',"%".$cari."%")
    ->paginate(Fungsi::paginationjml());



    $bukurak = DB::table('bukurak')->get();
    $bukukategori = DB::table('kategori')->where('prefix','ddc')->get();

    return view('admin.buku.index',compact('pages','bukurak','bukukategori','datas','request'));
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
               'penerbit'     =>   $request->penerbit,
               'tahunterbit'     =>   $request->tahunterbit,
               'bahasa'     =>   $request->bahasa,
               'created_at'=>date("Y-m-d H:i:s"),
               'updated_at'=>date("Y-m-d H:i:s")
        ));

        $notification = array(
            'message' => 'Post created successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with('status','Data berhasil di tambahkan!')->with('tipe','success');
    
    }
    public function show(Request $request,buku $id)
    {
        // dd($id);
        #WAJIB
        $pages='buku';
        $datas=$id;
        
        $bukurak = DB::table('bukurak')->get();
        $bukukategori = DB::table('kategori')->where('prefix','ddc')->get();

        return view('admin.buku.edit',compact('pages','datas','bukurak','bukukategori','request'));
    }
    public function proses_update($request,$datas)
    {
        if($request->nama!==$datas->nama){
            $request->validate([
                'nama'=>'unique:bukurak,nama'
            ],
            [
                // 'nama.unique'=>'Nama harus diisi'


            ]);
        }
        
        if($request->kode!==$datas->kode){
            $request->validate([
                'kode'=>'unique:bukurak,kode'
            ],
            [
                // 'nama.unique'=>'Nama harus diisi'


            ]);
        }

       
       
        $ambilbukurak_kode = DB::table('bukurak')->where('nama',$request->bukurak_nama)->first();
        $ambilbukukategori_ddc = DB::table('kategori')->where('nama',$request->bukukategori_nama)->first();

     
        if($request->bukukategori_nama==$datas->bukukategori_nama){
            $kodebuku=$datas->kode;
        }else{
            $kodebuku=Fungsi::autokodebuku($ambilbukukategori_ddc->kode);
                    if($kodebuku==='penuh'){
                        return redirect()->back()->with('status','Data Gagal di tambahkan karena kode buku penuh!')->with('tipe','error')->with('icon','fas fa-feather');

                    }
        }
        // dd($request->bukukategori_nama,$datas->bukukategori_nama,$kodebuku);

        buku::where('id',$datas->id)
        ->update([
            'nama'     =>   $request->nama,
            'kode'     =>   $kodebuku,
            'bukukategori_ddc'     =>   $ambilbukukategori_ddc->kode,
            'bukukategori_nama'     =>   $request->bukukategori_nama,
            'bukurak_kode'     =>   $ambilbukurak_kode->kode,
            'bukurak_nama'     =>   $request->bukurak_nama,
            'penerbit'     =>   $request->penerbit,
            'tahunterbit'     =>   $request->tahunterbit,
            'bahasa'     =>   $request->bahasa,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);

        
    }

    public function update(Request $request, buku $id)
    {
        $this->proses_update($request,$id);

            return redirect()->back()->with('status','Data berhasil diupdate!')->with('tipe','success')->with('icon','fas fa-edit');
    }
    
    public function destroy($id)
    {
        buku::destroy($id);
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
        buku::whereIn('id',$ids)->delete();

        
        // load ulang
     
       
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

    }
}
