<?php

namespace App\Http\Controllers;

use App\Models\Supervisi;
use Illuminate\Http\Request;

class SupervisiController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranFilter = $request->query('tahun_ajaran', '');

        $query = Supervisi::query();

        if ($tahunAjaranFilter) {
            $query->where('tahun_ajaran', $tahunAjaranFilter);
        }

        $supervisi = Supervisi::latest()->paginate(10);

        $tahunAjaranOptions = Supervisi::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

        return view('supervisi.index', compact('supervisi', 'tahunAjaranOptions', 'tahunAjaranFilter'));
    }

    public function create()
    {
        return view('supervisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
            'nama_guru' => 'string|required',
            'kelas' => 'string|required',
            'mapel' => 'string|required',
        ]);

        $supervisi = new Supervisi();
        $supervisi->tahun_ajaran = $request->tahun_ajaran;
        $supervisi->nama_guru = $request->nama_guru;
        $supervisi->kelas = $request->kelas;
        $supervisi->mapel = $request->mapel;

        $supervisi->save();

        return redirect()->route('supervisi.index')->with('success', 'Supervisi created successfully.');
    }

    public function edit($id)
    {
        $supervisi = Supervisi::findOrFail($id);
        return view('supervisi.edit', compact('supervisi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
            'nama_guru' => 'string|required',
            'kelas' => 'string|required',
            'mapel' => 'string|required',
        ]);

        $supervisi = Supervisi::findOrFail($id);
        $supervisi->tahun_ajaran = $request->tahun_ajaran;
        $supervisi->nama_guru = $request->nama_guru;
        $supervisi->kelas = $request->kelas;
        $supervisi->mapel = $request->mapel;

        $supervisi->save();

        return redirect()->route('supervisi.index')->with('success', 'Supervisi updated successfully.');
    }

    public function destroy($id)
    {
        $supervisi = Supervisi::findOrFail($id);

        $supervisi->delete();


        return redirect()->route('supervisi.index')->with('success', 'Supervisi deleted successfully.');
    }
}
