<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukudetail extends Model
{
    public $table = "buku";

    use HasFactory;

    protected $fillable = [
        'isbn',
        'buku_nama',
        'buku_kode',
        'bukurak_nama',
        'bukukategori_nama',
        'bukukategori_ddc',
    ];
}
