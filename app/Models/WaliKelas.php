<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;

    protected $table = 'walas';

    protected $fillable = [
        'tahun_ajaran',
        'penyerahan_rapor'
    ];
}
