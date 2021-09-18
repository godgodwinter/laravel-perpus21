<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukudetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukudetail', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->nullable();
            $table->string('buku_kode')->nullable();
            $table->string('buku_nama')->nullable();
            $table->string('bukurak_nama')->nullable();
            $table->string('bukukategori_nama')->nullable();  //ktp / kartu pelajar
            $table->string('bukukategori_ddc')->nullable(); //dari table kategori.kode
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
        Schema::dropIfExists('bukudetail');
    }
}
