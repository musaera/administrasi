<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWakaKurikulumTable extends Migration
{
    public function up()
    {
        Schema::create('waka_kurikulum', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');
            // Adding columns for Buku Prog. Bimbingan
            $table->string('nomor_bimbingan');
            $table->string('waktu_bimbingan');
            $table->string('nama_bimbingan');
            $table->string('kekurangan_bimbingan');
            $table->string('bentuk_bimbingan');
            $table->string('hasil_bimbingan');
            $table->string('keterangan_bimbingan');
            // Adding columns for Buku capaian target dan daya serap
            $table->string('nomor_capaian');
            $table->string('mapel_capaian');
            $table->string('guru_capaian');
            $table->string('target_pencapaian_materi');
            $table->string('realisasi_pencapaian');
            $table->string('kendala');
            $table->string('solusi');
            $table->string('keterangan_capaian');
            // Adding columns for Kenaikan Kelas X,XI,XII bentukn file upload
            $table->string('kenaikan_kelas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('waka_kurikulum');
    }
}
