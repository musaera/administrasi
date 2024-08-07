<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels';

    protected $fillable = [
        'tahun_ajaran',
        'kelas',
        'mapel',
        'kategori_kurikulum',
        'rpp',
        'silabus',
        'ki_kd_skl',
        'kode_etik',
        'program_semester',
        'program_tahunan',
        'kaldik_sekolah',
        'jak',
        'analisi_waktu',
        'daftar_hadir_siswa',
        'jadwal_pelajaran',
        'kisi_kisi_soal_kartu_soal',
        'pkg',
    ];
}
