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

    public function pengunjung(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }
        // dd($id);

        #WAJIB
        $pages='pengunjung';
        $jmldata='0';
        $datas='0';

        $datas=DB::table('pengunjung')->orderBy('tgl','desc')->get();
        $jml=DB::table('pengunjung')->orderBy('tgl','desc')->count();
        // ->orderBy('isbn','asc')
        // ->paginate(Fungsi::paginationjml());

        // $bukurak = DB::table('bukurak')->get();
        // $bukukategori = DB::table('kategori')->where('prefix','ddc')->get();

        return view('admin.laporan.pengunjung',compact('pages','datas','request','jml'));
        // return view('admin.beranda');
    }

    public function laporanpeminjaman(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }
        // dd($id);

        #WAJIB
        $pages='pengunjung';
        $jmldata='0';
        $datas='0';

        $datas=DB::table('peminjamandetail')->orderBy('tgl_pinjam','desc')->get();
        $jml=DB::table('peminjamandetail')->orderBy('tgl_pinjam','desc')->count();
        // ->orderBy('isbn','asc')
        // ->paginate(Fungsi::paginationjml());

        // $bukurak = DB::table('bukurak')->get();
        // $bukukategori = DB::table('kategori')->where('prefix','ddc')->get();

        return view('admin.laporan.peminjaman',compact('pages','datas','request','jml'));
        // return view('admin.beranda');
    }

    public function laporankeuangan(Request $request)
    {
        if($this->checkauth('admin')==='404'){
            return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        }
        // dd($id);

        #WAJIB
        $pages='pengunjung';
        $jmldata='0';
        $datas='0';

        $datas=DB::table('pengunjung')->orderBy('tgl','desc')->get();
        $jml=DB::table('pengunjung')->orderBy('tgl','desc')->count();
        // ->orderBy('isbn','asc')
        // ->paginate(Fungsi::paginationjml());

        // $bukurak = DB::table('bukurak')->get();
        // $bukukategori = DB::table('kategori')->where('prefix','ddc')->get();

        return view('admin.laporan.pengunjung',compact('pages','datas','request','jml'));
        // return view('admin.beranda');
    }

    public function apipeminjaman(Request $request)
    {

        $output = '';
        $cari=$request->cari;
        $month = date("m",strtotime($request->bln));
        $year = date("Y",strtotime($request->bln));
        // $month = $request->bln;
        // dd($month);
if($request->status=='sudah'){
    $jml=DB::table('peminjamandetail')
    ->where('buku_nama','like',"%".$cari."%")->where('statuspengembalian',$request->status)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_pengarang','like',"%".$cari."%")->where('statuspengembalian',$request->status)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_penerbit','like',"%".$cari."%")->where('statuspengembalian',$request->status)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->count();


    $datas=DB::table('peminjamandetail')
    ->where('buku_nama','like',"%".$cari."%")->where('statuspengembalian',$request->status)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_pengarang','like',"%".$cari."%")->where('statuspengembalian',$request->status)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_penerbit','like',"%".$cari."%")->where('statuspengembalian',$request->status)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)->orderBy('tgl_pinjam','desc')
    ->get();

    $first=DB::table('peminjamandetail')
    ->where('buku_nama','like',"%".$cari."%")->where('statuspengembalian',$request->status)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_pengarang','like',"%".$cari."%")->where('statuspengembalian',$request->status)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_penerbit','like',"%".$cari."%")->where('statuspengembalian',$request->status)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->first();

}elseif($request->status=='belum'){
    $jml=DB::table('peminjamandetail')
    ->where('buku_nama','like',"%".$cari."%")->where('statuspengembalian',null)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_pengarang','like',"%".$cari."%")->where('statuspengembalian',null)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_penerbit','like',"%".$cari."%")->where('statuspengembalian',null)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->count();


    $datas=DB::table('peminjamandetail')
    ->where('buku_nama','like',"%".$cari."%")->where('statuspengembalian',null)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_pengarang','like',"%".$cari."%")->where('statuspengembalian',null)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_penerbit','like',"%".$cari."%")->where('statuspengembalian',null)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orderBy('tgl_pinjam','desc')->get();

    $first=DB::table('peminjamandetail')
    ->where('buku_nama','like',"%".$cari."%")->where('statuspengembalian',null)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_pengarang','like',"%".$cari."%")->where('statuspengembalian',null)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_penerbit','like',"%".$cari."%")->where('statuspengembalian',null)->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->first();


}else{
    $jml=DB::table('peminjamandetail')
    ->where('buku_nama','like',"%".$cari."%")->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_pengarang','like',"%".$cari."%")->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_penerbit','like',"%".$cari."%")->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->count();


    $datas=DB::table('peminjamandetail')
    ->where('buku_nama','like',"%".$cari."%")->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_pengarang','like',"%".$cari."%")->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_penerbit','like',"%".$cari."%")->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)->orderBy('tgl_pinjam','desc')
    ->get();

    $first=DB::table('peminjamandetail')
    ->where('buku_nama','like',"%".$cari."%")->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_pengarang','like',"%".$cari."%")->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->orWhere('buku_penerbit','like',"%".$cari."%")->whereMonth('tgl_pinjam',$month)->whereYear('tgl_pinjam',$year)->skip(0)->take(10)
    ->first();

}

        if($jml>0){

            $no=0;
                foreach($datas as $data){

        if($data->statuspengembalian=='sudah'){
                $warna='success';
                $status='Sudah dikembalikan';
        }else{
                $warna='warning';
                $status='Belum dikembalikan';
        }
                    $ambilpeminjam=DB::table('peminjaman')->where('kodetrans',$data->kodetrans)->first();

                    $no++;
                $output .= '
                <tr>
                      <td>
                         '.($no).'
                      </td>
                      <td>
                          <a>
                             '.$data->buku_nama.'
                          </a>

                      </td>
                      <td>
                      Pengarang : '.$data->buku_pengarang.'
                      <small>
                      Penerbit : '.$data->buku_penerbit.'
                      </small>
                      </td>
                      <td class="project_progress">

                        '.Fungsi::tanggalindo($data->tgl_pinjam).'</td>
                        <td class="project_progress">

                          '.$data->nomeridentitas.' - '.$ambilpeminjam->nama.'</td>
                      <td class="project-state">

                          <span class="badge badge-'.$warna.'">'.$status.'</span>
                      </td>

                  </tr>

                ';
                }
         }else{
            $output = '
            <tr>
             <td align="center" colspan="5">No Data Found</td>
            </tr>
            ';

         }
        // echo json_encode($datas);

        return response()->json([
            'success' => true,
            'message' => $jml,
            'show' => $output,
            // 'status' => $data->status,
            'datas' => $datas,
            'first' => $first
        ], 200);

        dd($datas);


    }
    public function keuanganapi(Request $request)
    {

    }
    public function pengunjungapi(Request $request)
    {

        $output = '';
        $cari=$request->cari;
        $month = date("m",strtotime($request->bln));
        $year = date("Y",strtotime($request->bln));
        // $month = $request->bln;
        // dd($month);

        $jml=DB::table('pengunjung')
        ->where('nama','like',"%".$cari."%")->whereMonth('tgl',$month)->whereYear('tgl',$year)->skip(0)->take(10)
        ->orWhere('nomeridentitas','like',"%".$cari."%")->whereMonth('tgl',$month)->whereYear('tgl',$year)->skip(0)->take(10)
        ->orWhere('tipe','like',"%".$cari."%")->whereMonth('tgl',$month)->whereYear('tgl',$year)->skip(0)->take(10)
        ->count();


        $datas=DB::table('pengunjung')
        ->where('nama','like',"%".$cari."%")->whereMonth('tgl',$month)->whereYear('tgl',$year)->skip(0)->take(10)
        ->orWhere('nomeridentitas','like',"%".$cari."%")->whereMonth('tgl',$month)->whereYear('tgl',$year)->skip(0)->take(10)
        ->orWhere('tipe','like',"%".$cari."%")->whereMonth('tgl',$month)->whereYear('tgl',$year)->skip(0)->take(10)
        ->get();

        $first=DB::table('pengunjung')
        ->where('nama','like',"%".$cari."%")->whereMonth('tgl',$month)->whereYear('tgl',$year)->skip(0)->take(10)
        ->orWhere('nomeridentitas','like',"%".$cari."%")->whereMonth('tgl',$month)->whereYear('tgl',$year)->skip(0)->take(10)
        ->orWhere('tipe','like',"%".$cari."%")->whereMonth('tgl',$month)->whereYear('tgl',$year)->skip(0)->take(10)
        ->first();

        if($jml>0){

            $no=0;
                foreach($datas as $data){
                    $no++;
                $output .= '
                <tr>
                      <td>
                         '.($no+1).'
                      </td>
                      <td>
                          <a>
                             '.$data->nama.'
                          </a>

                      </td>
                      <td>
                      '.$data->nomeridentitas.'
                      </td>
                      <td class="project_progress">

                        '.Fungsi::tanggalindo($data->tgl).'</td>
                      <td class="project-state">

                          <span class="badge badge-success">'.$data->tipe.'</span>
                      </td>

                  </tr>

                ';
                }
         }else{
            $output = '
            <tr>
             <td align="center" colspan="5">No Data Found</td>
            </tr>
            ';

         }
        // echo json_encode($datas);

        return response()->json([
            'success' => true,
            'message' => $jml,
            'show' => $output,
            // 'status' => $data->status,
            'datas' => $datas,
            'first' => $first
        ], 200);

        dd($datas);

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
