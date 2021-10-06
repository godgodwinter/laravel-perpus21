<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminbukudigitalcontroller extends Controller
{
    public function index(Request $request)
    {
        // if($this->checkauth('admin')==='404'){
        //     return redirect(URL::to('/').'/404')->with('status','Halaman tidak ditemukan!')->with('tipe','danger')->with('icon','fas fa-trash');
        // }

        #WAJIB
        $pages='bukudigital';
        $jmldata='0';
        $datas='0';


        $datas=DB::table('bukudigital')
        ->orderBy('nama','asc')
        ->paginate(Fungsi::paginationjml());

        // $bukudigitalkategori = DB::table('kategori')->where('prefix','tipebukudigital')->get();
        // $kondisi = DB::table('kategori')->where('prefix','kondisi')->get();

        return view('admin.bukudigital.index',compact('pages','datas','request'));
        // return view('admin.beranda');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'tipe'=>'required',
            'file' => 'max:2000|mimes:pdf,png,jpeg,xml', //1MB
        ],
        [
            'nama.required'=>'Nama Harus diisi',

        ]);

        // $validator = Validator::make($request->all(), [
        //     'file' => 'max:5120', //5MB
        // ]);

        $files = $request->file('file');

        // dd($request);
        $namafileku=null;
        if($files!=null){
            // dd(!Input::hasFile('files'));
            // dd($files,'aaa');
            $namafilebaru=date('YmdHis');

            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');
                      // nama file
            echo 'File Name: '.$file->getClientOriginalName();
            echo '<br>';

                      // ekstensi file
            echo 'File Extension: '.$file->getClientOriginalExtension();
            // dd()
            echo '<br>';

                      // real path
            echo 'File Real Path: '.$file->getRealPath();
            echo '<br>';

                      // ukuran file
            echo 'File Size: '.$file->getSize();
            echo '<br>';

                      // tipe mime
            echo 'File Mime Type: '.$file->getMimeType();

                      // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'bukudigital/';

                    // upload file
            $file->move($tujuan_upload,"bukudigital/".$namafilebaru.'.'.$file->getClientOriginalExtension());
                $namafileku="bukudigital/".$namafilebaru.'.'.$file->getClientOriginalExtension();
            }

        DB::table('bukudigital')->insert(
            array(
                   'nama'     =>   $request->nama,
                   'tipe'     =>   $request->tipe,
                   'ket'     =>   $request->ket,
                   'link'     =>   $request->link,
                //    'gambar'     =>   $request->gambar,
                    'file' => $namafileku,
                   'created_at'=>date("Y-m-d H:i:s"),
                   'updated_at'=>date("Y-m-d H:i:s")
            ));
            return redirect()->back()->with('status','Data berhasil di tambahkan!')->with('tipe','success');

     }
}
