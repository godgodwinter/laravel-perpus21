<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    public $table = "buku";

    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
        'bukurak_nama',
        'bukukategori_nama',
        'bukukategori_ddc',
    ];
}
