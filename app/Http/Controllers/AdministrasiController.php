<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    public function mapel()
    {
        return view('your-view-for-mapel');
    }

    public function kepalaLabKom()
    {
        return view('your-view-for-kepalaLabKom');
    }

    public function osis()
    {
        return view('your-view-for-osis');
    }

    public function perpustakaan()
    {
        return view('your-view-for-perpustakaan');
    }

    public function walas()
    {
        return view('your-view-for-walas');
    }

    public function kepsek()
    {
        return view('your-view-for-kepsek');
    }

    public function wakaKurikulum()
    {
        return view('your-view-for-wakaKurikulum');
    }

    public function wakaKesiswaan()
    {
        return view('your-view-for-wakaKesiswaan');
    }

    public function supervisi()
    {
        return view('your-view-for-supervisi');
    }
}
