<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Kepsek;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KepsekController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranFilter = $request->query('tahun_ajaran', '');

        $query = Kepsek::query();

        if ($tahunAjaranFilter) {
            $query->where('tahun_ajaran', $tahunAjaranFilter);
        }

        $kepsek = Kepsek::latest()->paginate(10);

        $tahunAjaranOptions = Kepsek::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

        return view('kepsek.index', compact('kepsek', 'tahunAjaranOptions', 'tahunAjaranFilter'));
    }

    public function create()
    {
        return view('kepsek.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tahun_ajaran' => 'required',
            // proker_kepsek
            'proker_kepsek' => 'nullable|file',
            // RKTS
            'rkts' => 'nullable|file',
            // RKJM
            'rkjm' => 'nullable|file',
            // Prog. Jangka Panjang
            'prog_jangka_panjang' => 'nullable|file',
            // RAPBS
            'rapbs' => 'nullable|file',
            // Penilaian Bulanan Guru
            'nomor_penilaian' => 'required|string',
            'nama_guru' => 'required|string',
            'nilai_tepat_waktu' => 'required|string',
            'penilaian_kumulatif_siswa' => 'required|string',
            'capaian_materi' => 'required|string',
            'prestasi' => 'required|string',
            'bulan' => 'required|string',
            'keterangan_penilaian_bulanan' => 'required|string',
            // Daftar Pembagian Tugas Guru
            'nomor_pembagian_tugas' => 'required|string',
            'nama_pembagian_tugas' => 'required|string',
            'kelas' => 'required|string',
            'jabatan' => 'required|string',
            'mapel' => 'required|string',
            'jumlah_jp' => 'required|string',
            'keterangan_pembagian_tugas' => 'required|string'
        ]);

        $fileFields = [
            'proker_kepsek',
            'rkts',
            'rkjm',
            'prog_jangka_panjang',
            'rapbs',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            }
        }

        Kepsek::create($validateData);

        return redirect()->route('kepsek.index')->with('success', 'Data Kepsek created successfully.');
    }

    public function edit($id)
    {
        $kepsek = Kepsek::findOrFail($id);
        return view('kepsek.edit', compact('kepsek'));
    }

    public function update(Request $request, $id)
    {
        $kepsek = Kepsek::findOrFail($id);

        $validateData = $request->validate([
            'tahun_ajaran' => 'required',
            // proker_kepsek
            'proker_kepsek' => 'nullable|file',
            // RKTS
            'rkts' => 'nullable|file',
            // RKJM
            'rkjm' => 'nullable|file',
            // Prog. Jangka Panjang
            'prog_jangka_panjang' => 'nullable|file',
            // RAPBS
            'rapbs' => 'nullable|file',
            // Penilaian Bulanan Guru
            'nomor_penilaian' => 'required|string',
            'nama_guru' => 'required|string',
            'nilai_tepat_waktu' => 'required|string',
            'penilaian_kumulatif_siswa' => 'required|string',
            'capaian_materi' => 'required|string',
            'prestasi' => 'required|string',
            'bulan' => 'required|string',
            'keterangan_penilaian_bulanan' => 'required|string',
            // Daftar Pembagian Tugas Guru
            'nomor_pembagian_tugas' => 'required|string',
            'nama_pembagian_tugas' => 'required|string',
            'kelas' => 'required|string',
            'jabatan' => 'required|string',
            'mapel' => 'required|string',
            'jumlah_jp' => 'required|string',
            'keterangan_pembagian_tugas' => 'required|string'
        ]);

        $fileFields = [
            'proker_kepsek',
            'rkts',
            'rkjm',
            'prog_jangka_panjang',
            'rapbs',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                // Jika ada file baru, hapus file lama jika ada
                if (isset($validateData[$fileField])) {
                    $oldFile = $validateData[$fileField];
                    if ($oldFile && Storage::exists($oldFile)) {
                        Storage::delete($oldFile);
                    }
                }
                // Simpan file baru
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            } else {
                // Jika tidak ada file baru, pertahankan data lama
                if (isset($validateData[$fileField])) {
                    $validateData[$fileField] = $validateData[$fileField];
                }
            }
        }

        $kepsek->update($validateData);

        return redirect()->route('kepsek.index')->with('success', 'Data Kepsek berhasil diubah!');
    }

    public function destroy($id)
    {
        $kepsek = Kepsek::find($id);

        $fileFields = [
            'proker_kepsek',
            'rkts',
            'rkjm',
            'prog_jangka_panjang',
            'rapbs',
        ];

        foreach ($fileFields as $fileField) {
            if ($kepsek->$fileField) {
                Storage::delete($kepsek->$fileField);
            }
        }

        $kepsek->delete();

        return redirect()->route('kepsek.index')->with('success', 'Data Kepsek berhasil dihapus!');
    }

    public function downloadFiles($id)
    {
        $kepsek = Kepsek::findOrFail($id);

        $directories = [
            'proker_kepsek',
            'rkts',
            'rkjm',
            'prog_jangka_panjang',
            'rapbs',
        ];

        // Create a temporary file to store the zip
        $zipFileName = 'Kepsek_files_' . $kepsek->tahun_ajaran . '.zip';
        $zipFilePath = storage_path('app/temp/' . $zipFileName);

        // Ensure the temp directory exists
        if (!Storage::exists('temp')) {
            Storage::makeDirectory('temp');
            Log::info('Created temp directory: ' . storage_path('app/temp'));
        }

        // Initialize zip archive
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($directories as $dir) {
                if ($kepsek->$dir) {
                    $filePath = storage_path('app/' . $kepsek->$dir);
                    if (file_exists($filePath)) {
                        $zip->addFile($filePath, $dir . '/' . basename($filePath));
                    }
                }
            }
            $zip->close();

            // Download the created zip file
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return back()->with('error', 'Failed to create zip file');
        }
    }

    public function exportPDF($id)
    {
        $data = Kepsek::findOrFail($id);
        $pdf = FacadePdf::loadView('kepsek.pdf', compact('data'));
        return $pdf->download('kepsek.pdf');
    }
}
