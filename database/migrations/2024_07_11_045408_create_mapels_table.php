<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelsTable extends Migration
{
    public function up()
    {
        Schema::create('mapels', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');
            $table->string('kelas');
            $table->string('mapel');
            $table->string('kategori_kurikulum');
            $table->text('rpp')->nullable();
            $table->string('silabus')->nullable();
            $table->string('ki_kd_skl')->nullable();
            $table->string('kode_etik')->nullable();
            $table->string('program_semester')->nullable();
            $table->string('program_tahunan')->nullable();
            $table->string('kaldik_sekolah')->nullable();
            $table->string('jak')->nullable();
            $table->string('analisi_waktu')->nullable();
            $table->string('daftar_hadir_siswa')->nullable();
            $table->string('jadwal_pelajaran')->nullable();
            $table->string('kisi_kisi_soal_kartu_soal')->nullable();
            $table->string('pkg')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mapels');
    }
}
