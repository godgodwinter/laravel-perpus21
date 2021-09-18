<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembaliandetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembaliandetail', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->nullable(); //dari table kategori
            $table->string('nomeridentitas')->nullable();
            $table->string('buku_nama')->nullable();
            $table->string('bukurak_nama')->nullable();
            $table->string('bukukategori_nama')->nullable();  //ktp / kartu pelajar
            $table->string('bukukategori_ddc')->nullable(); //dari table kategori
            $table->string('jaminan_nama')->nullable(); //dari table kategori
            $table->string('jaminan_tipe')->nullable(); //dari table kategori
            $table->string('tgl_pinjam')->nullable(); //dari peminjamandetail
            $table->string('tgl_harus_kembali')->nullable(); //diambil peminjamandetail
            $table->string('tgl_dikembalikan')->nullable(); //timestamp
            $table->string('totaldenda')->nullable(); //diambil dari settings denda
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembaliandetail');
    }
}
