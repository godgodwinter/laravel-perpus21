<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Models\tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class settingsController extends Controller
{
    public function index()
    {
        $pages='settings';

        return view('admin.pages.settings',compact('pages'
        // ,'settings'
    ));
    }
    
    public function proses_update($request,$datas)
    {

       
       
        

        settings::where('id',$datas->id)
        ->update([
            'aplikasijudul'     =>   $request->aplikasijudul,
            'aplikasijudulsingkat'     =>   $request->aplikasijudulsingkat,
            'paginationjml'     =>   $request->paginationjml,
            'passdefaultadmin'     =>   $request->passdefaultadmin,
            'passdefaultpegawai'     =>   $request->passdefaultpegawai,
            'sekolahttd'     =>   $request->sekolahttd,
            'defaultdenda'     =>   $request->defaultdenda,
            'defaultminbayar'     =>   $request->defaultminbayar,
            'defaultmaxbukupinjam'     =>   $request->defaultmaxbukupinjam,
            'defaultmaxharipinjam'     =>   $request->defaultmaxharipinjam,
            'sekolahnama'     =>   $request->sekolahnama,
            'sekolahalamat'     =>   $request->sekolahalamat,
            'sekolahtelp'     =>   $request->sekolahtelp,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);

        
    }

    public function update(Request $request, settings $id)
    {
        $this->proses_update($request,$id);

            return redirect()->back()->with('status','Data berhasil diupdate!')->with('tipe','success')->with('icon','fas fa-edit');
    }
}
