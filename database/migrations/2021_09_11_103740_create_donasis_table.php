<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('kategori');
            $table->string('tingkatan');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('target');
            $table->integer('jumlah_kini');
            $table->string('status');
            $table->string('foto')->nullable();
            $table->string('nama_bank');
            $table->string('no_rek');
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
        Schema::dropIfExists('donasis');
    }
}
