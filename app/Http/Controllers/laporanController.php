<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\kelas;
use App\Models\pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class laporanController extends Controller
{
    public function index()
    {
        #WAJIB
        $pages='laporan';
        $jmldata='0';
        $datas='0';


        $datas=DB::table('kelas')
        ->paginate($this->paginationjml());

        $jmldata = DB::table('kelas')->count();

        return view('admin.laporan.index',compact('pages','jmldata','datas'));
    }
    public function pengunjung(Request $request, pengunjung $id)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }
        // dd($id);

        #WAJIB
        $pages='pengunjung';
        $jmldata='0';
        $datas='0';
        $buku=$id;


        $datas=DB::table('pengunjung')->where('nama',$id->nama)->orderBy('created_at','desc')
        // ->orderBy('isbn','asc')
        ->paginate(Fungsi::paginationjml());

        // $bukurak = DB::table('bukurak')->get();
        // $bukukategori = DB::table('kategori')->where('prefix','ddc')->get();

        return view('admin.laporan.pengunjung',compact('pages','datas','request'));
        // return view('admin.beranda');
    }

    public function cetak()
    {
        $tgl=date("YmdHis");
        // dd($tgl);
        $databos=DB::table('pemasukan')->where('kategori_nama','Dana Bos')->get();
        $datapemasukan=DB::table('pemasukan')->whereNotIn('kategori_nama', ['Dana Bos'])->get();
        $datapengeluaran=DB::table('pengeluaran')->get();
        // dd($datapengeluaran);

        $pdf = PDF::loadview('admin.laporan.cetak',compact('databos','datapemasukan','datapengeluaran'))->setPaper('a4', 'potrait');
        
        // \QrCode::size(500)
        //     ->format('png')
        //     ->generate('www.google.com', public_path('assets/img/qrcode.png'));

        return $pdf->download('laporansekolah_'.$tgl.'-pdf');
    }
    public function qr(){

        // \QrCode::size(500)
        //     ->format('png')
        //     ->generate('www.google.com', public_path('assets/img/qrcode.png'));

            return view('admin.testing.qr');
    }
}
