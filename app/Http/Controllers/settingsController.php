<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use App\Models\bukudetail;
use App\Models\bukurak;
use App\Models\peminjaman;
use App\Models\peminjamandetail;
use App\Models\pengembalian;
use App\Models\pengembaliandetail;
use App\Models\peralatan;
use App\Models\settings;
use App\Models\tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

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
    
    public function hard(){
        
        buku::truncate();
        bukudetail::truncate();
        bukurak::truncate();
        anggota::truncate();
        peralatan::truncate();
        peminjaman::truncate();
        peminjamandetail::truncate();
        pengembalian::truncate();
        pengembaliandetail::truncate();

        return redirect()->back()->with('status','Data berhasil diupdate!')->with('tipe','success')->with('icon','fas fa-edit');
    }
    
    public function bukurak(){
        $jmldata=10;
        $limitdata=200;
        $cekdata=DB::table('bukurak')
        ->count();
        if($cekdata>$limitdata){
            return redirect()->back()->with('status','Gagal! Data siswa lebih dari '.$limitdata)->with('tipe','error')->with('icon','fas fa-trash');
        }
        
        bukurak::truncate();
        
        $faker = Faker::create('id_ID');
        for($i=0;$i<$jmldata;$i++){
            // 3. insert data siswa
                $nama='RAK '.($i+1);
                $kode='R '.($i+1);
                DB::table('bukurak')->insert([
                    'nama' => $nama,
                    'kode' => $kode,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
     }
     return redirect()->back()->with('status','Data berhasil diupdate!')->with('tipe','success')->with('icon','fas fa-edit');
    }
    public function buku(){
        $jmldata=20;
        $limitdata=200;
        
        $cekdata=DB::table('anggota')
        ->count();
        if($cekdata>$limitdata){
            return redirect()->back()->with('status','Gagal! Data siswa lebih dari '.$limitdata)->with('tipe','error')->with('icon','fas fa-trash');
        }
        
        $faker = Faker::create('id_ID');
        for($i=0;$i<$jmldata;$i++){
            $nama=$faker->name;
            $nomeridentitas=date('YmdHis').$i;
            // 3. insert data siswa
                $kode='R '.($i+1);
                DB::table('anggota')->insert([
                    'nama' => $nama,
                    'tipe' => $faker->randomElement(['Siswa', 'Umum']),
                    'tempatlahir' => $faker->randomElement(['Sumbersari', 'Jakarta','Surabaya','Blitar']),
                    'tgllahir' => $faker->numberBetween(1990,2020).'-0'.$faker->numberBetween(1,9).'-'.$faker->numberBetween(10,29),
                    'alamat' => 'Desa '.$faker->randomElement(['Sumbersari', 'Sumbermakmur','Mulyorejo','Morodadi']).' Kecamatan Losari Kabupaten Malang',
                    'nomeridentitas' => $nomeridentitas,
                    'sekolahasal' => $faker->randomElement(['Sumbersari', 'Jakarta','Surabaya','Blitar']),
                    'jk' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                    'telp' => $nomeridentitas,
                    'agama' => $faker->randomElement(['Islam', 'Kristen','Hindu','Budha']),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
     }
     return redirect()->back()->with('status','Data berhasil diupdate!')->with('tipe','success')->with('icon','fas fa-edit');
    }
    
    public function bukudetail(){
        $jmldata=20;
        $limitdata=200;
    }
    public function anggota(){
        $jmldata=20;
        $limitdata=200;

        $cekdata=DB::table('anggota')
        ->count();
        if($cekdata>$limitdata){
            return redirect()->back()->with('status','Gagal! Data siswa lebih dari '.$limitdata)->with('tipe','error')->with('icon','fas fa-trash');
        }
        
        $faker = Faker::create('id_ID');
        for($i=0;$i<$jmldata;$i++){
            $nama=$faker->name;
            $nomeridentitas=date('YmdHis').$i;
            // 3. insert data siswa
                $kode='R '.($i+1);
                DB::table('anggota')->insert([
                    'nama' => $nama,
                    'tipe' => $faker->randomElement(['Siswa', 'Umum']),
                    'tempatlahir' => $faker->randomElement(['Sumbersari', 'Jakarta','Surabaya','Blitar']),
                    'tgllahir' => $faker->numberBetween(1990,2020).'-0'.$faker->numberBetween(1,9).'-'.$faker->numberBetween(10,29),
                    'alamat' => 'Desa '.$faker->randomElement(['Sumbersari', 'Sumbermakmur','Mulyorejo','Morodadi']).' Kecamatan Losari Kabupaten Malang',
                    'nomeridentitas' => $nomeridentitas,
                    'sekolahasal' => $faker->randomElement(['Sumbersari', 'Jakarta','Surabaya','Blitar']),
                    'jk' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                    'telp' => $nomeridentitas,
                    'agama' => $faker->randomElement(['Islam', 'Kristen','Hindu','Budha']),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
     }
     return redirect()->back()->with('status','Data berhasil diupdate!')->with('tipe','success')->with('icon','fas fa-edit');
    }
}
