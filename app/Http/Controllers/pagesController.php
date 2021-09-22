<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\arsip_siswa;
use App\Models\arsip_tagihanatur;
use App\Models\arsip_tagihansiswa;
use App\Models\arsip_tagihansiswadetail;
use App\Models\arsip_users;
use App\Models\kelas;
use App\Models\settings;
use App\Models\siswa;
use App\Models\tagihanatur;
use App\Models\tagihansiswa;
use App\Models\tagihansiswadetail;
use App\Models\tapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class pagesController extends Controller
{
    public function formatimport()
    {
        $pages='beranda';
        return view('admin.pages.formatimport',compact('pages'
    ));
    }

    public function guide()
    {
        $pages='beranda';
        return view('admin.pages.guide',compact('pages'
    ));
    }

    public function barcode()
    {
        $pages='beranda';
        return view('admin.testing.barcode',compact('pages'
    ));
    }

    public function tail()
    {
        $pages='beranda';
        return view('testing.tail',compact('pages'
    ));
    }
    public function landing()
    {
        $pages='beranda';
        return view('testing.landing',compact('pages'
    ));
    }

    public function cari()
    {
        $pages='beranda';
        $datas=[];
        return view('testing.cari',compact('pages','datas'
    ));
    }
    public function cariproses(Request $request)
    {

        $output = '';
        $cari=$request->cari;

        $jml=DB::table('buku')
        // ->where('nis','like',"%".$cari."%")
        ->where('nama','like',"%".$cari."%")
        ->orWhere('kode','like',"%".$cari."%")
        ->orWhere('isbn','like',"%".$cari."%")
        ->count();

        $datas=DB::table('buku')
        // ->where('nis','like',"%".$cari."%")
        ->where('nama','like',"%".$cari."%")
        ->orWhere('kode','like',"%".$cari."%")
        ->orWhere('isbn','like',"%".$cari."%")
        ->get();
        if($jml>0){

                foreach($datas as $row){
                    if($row->gambar==null){
                        $gambar='https://ui-avatars.com/api/?name='.$row->nama.'&color=7F9CF5&background=EBF4FF';
                    }else{
                        $gambar=$row->gambar;
                    }

                $output .= '<div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 mb-4 bg-white">
                <div class="max-w-lg rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="'.$gambar.'" alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                      <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                      <p class="text-gray-700 text-base">
                       '.$row->nama.'.
                      </p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                      <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">'.$row->isbn.'</span>
                      <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">'.$row->penerbit.'</span>
                      <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">'.$row->pengarang.'</span>
                    </div>
                  </div>
            </div>
               
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
            'datas' => $datas
        ], 200);

        dd($datas);



        #WAJIB





    // $bukurak = DB::table('bukurak')->get();
    $bukukategori = DB::table('kategori')->where('prefix','ddc')->get();

    return view('admin.buku.index',compact('pages'
    // ,'bukurak'
    ,'bukukategori','datas','request'));
    }



}
