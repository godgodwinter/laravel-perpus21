<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjamandetail extends Model
{
    public $table = "peminjamandetail";

    use HasFactory;

    protected $fillable = [
        'nama',
        'nomeridentitas',
        'isbn',
        'buku_nama',
        'bukurak_nama',
        'bukukategori_nama',
        'bukukategori_ddc',
        'jaminan_nama',
        'jaminan_tipe',
        'tgl_pinjam',
        'tgl_harus_kembali',
        'denda',
    ];
}
