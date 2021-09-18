<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukudetail extends Model
{
    public $table = "bukudetail";

    use HasFactory;

    protected $fillable = [
        'isbn',
        'buku_nama',
        'buku_penerbit',
        'buku_tahunterbit',
        'buku_bahasa',
        'buku_kode',
        'bukurak_nama',
        'bukurak_kode',
        'bukukategori_nama',
        'bukukategori_ddc',
        'status',
        'kodepanggil',
    ];
}
