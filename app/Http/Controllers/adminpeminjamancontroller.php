<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\bukudetail;
use Carbon\Carbon;
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

        // validator (lakukan di front end, jika tidak sesuai tidak dapat masuk kesini)
        // a.periksa jumlah tanggungan buku belum dikembalikan
        // b. buku masih dipinjam / rusak

        //1.insert anggota ke peminjaman
        $jaminan_nama=$request->nomeridentitas;
        if($request->jaminan_nama!=null){
            $jaminan_nama=$request->jaminan_nama;
        }
        $tgl_pinjam=date('Y-m-d');
        $tgl_harus_kembali=Fungsi::manipulasiTanggal($tgl_pinjam,Fungsi::defaultmaxharipinjam(),'days');
        // dd($jml,count($str),($str[0]),$datas,$request->nomeridentitas,$dataanggota->nama,$kodetrans,$decodekodetrans,$tgl_pinjam,$tgl_harus_kembali);

        DB::table('peminjaman')->insert([
            'kodetrans' => $kodetrans,
            'nama' => $dataanggota->nama,
            'nomeridentitas' =>$request->nomeridentitas,
            'jaminan_tipe' => $request->jaminan_tipe,
            'jaminan_nama' => $jaminan_nama,
            'tgl_pinjam' => $tgl_pinjam,
            'tgl_harus_kembali' =>$tgl_harus_kembali,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        //2/insert buku ke peminjaman detail where kodetransaksi
        
        for($i=0;$i<$jml;$i++){

            $datas=DB::table('bukudetail')->where('kodepanggil',$str[$i])->first();
            // dd($datas);
            DB::table('peminjamandetail')->insert([
                'kodetrans' => $kodetrans,
                'isbn' => $datas->isbn,
                'nomeridentitas' =>$request->nomeridentitas,
                'buku_nama' => $datas->buku_nama,
                'buku_kodepanggil' => $datas->kodepanggil,
                'buku_penerbit' => $datas->buku_penerbit,
                'buku_tahunterbit' => $datas->buku_tahunterbit,
                'buku_pengarang' => $datas->buku_pengarang,
                'buku_tempatterbit' => $datas->buku_tempatterbit,
                'buku_bahasa' => $datas->buku_bahasa,
                'bukurak_nama' => $datas->bukurak_nama,
                'bukukategori_nama' => $datas->bukukategori_nama,
                'bukukategori_ddc' => $datas->bukukategori_ddc,
                'jaminan_tipe' => $request->jaminan_tipe,
                'jaminan_nama' => $jaminan_nama,
                'tgl_pinjam' => $tgl_pinjam,
                'tgl_harus_kembali' =>$tgl_harus_kembali,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            
        //3.ubah status buku per exemplar bahwa dipinjam
        
        bukudetail::where('kodepanggil',$str[$i])
        ->update([
            'status'     =>  'dipinjam',
           'updated_at'=>date("Y-m-d H:i:s")
        ]);

            
        }
        
        return redirect()->back()->with('status','Proses Peminjaman Berhasil!')->with('tipe','success')->with('clearlocal','yes');


    }
    
    public function periksa($id)
    {
        
        $datas=DB::table('bukudetail')->where('kodepanggil',$id)->count();
        $data=DB::table('bukudetail')->where('kodepanggil',$id)->first();
        // //make response JSON
        if($datas>0){
            $ada=1;
            if($data->status!='ada'){
                $ada=0;
            }

            return response()->json([
                'success' => true,
                'message' => $ada,
                'status' => $data->status,
                'buku_nama' => $data->buku_nama,
                'bukukategori_nama' => $data->bukukategori_nama,
                'data'    => $id  
            ], 200);

        }else{
            $ada=1;
            if($data->status!='ada'){
                $ada=0;
            }
            return response()->json([
                'success' => true,
                'message' => $ada,
                'status' => $data->status,
                'buku_nama' => $data->buku_nama,
                'bukukategori_nama' => $data->bukukategori_nama,
                'data'    => $id  
            ], 200);

        }
    }

}
