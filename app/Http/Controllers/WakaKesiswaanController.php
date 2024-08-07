<?php

namespace App\Http\Controllers;

use ZipArchive;
use Illuminate\Http\Request;
use App\Models\WakaKesiswaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class WakaKesiswaanController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranFilter = $request->query('tahun_ajaran', '');

        $query = WakaKesiswaan::query();

        if ($tahunAjaranFilter) {
            $query->where('tahun_ajaran', $tahunAjaranFilter);
        }

        $wakaKesiswaan = WakaKesiswaan::latest()->paginate(10);

        $tahunAjaranOptions = WakaKesiswaan::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

        return view('waka_kesiswaan.index', compact('wakaKesiswaan', 'tahunAjaranFilter', 'tahunAjaranOptions'));
    }

    public function create()
    {
        return view('waka_kesiswaan.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tahun_ajaran' => 'required',
            // Buku Penyelesaian Kasus
            'nomor_penyelesaian_kasus' => 'string',
            'nama_penyelesaian_kasus' => 'string',
            'tanggal_kejadian' => 'string',
            'uraian_kasus' => 'string',
            'cara_menyelesaikan' => 'string',
            'tindak_lanjut' => 'string',
            'keterangan_penyelesaian_kasus' => 'string',
            // Buku Hubin
            'nomor_hubin' => 'string',
            'tanggal_kunjungan' => 'string',
            'tempat_kunjungan' => 'string',
            'nama_peserta' => 'string',
            'hasil_kunjungan' => 'string',
            'keterangan_hubin' => 'string',
            // CPD Tahun Pelajaran
            'tahun_pel' => 'nullable|file',
            // Pelatihan Siswa
            'nomor_pelatihan_siswa' => 'string',
            'nama_pelatihan_siswa' => 'string',
            'materi_pelatihan_siswa' => 'string',
            'tempat_pelatihan_siswa' => 'string',
            'tanggal_pelatihan_siswa' => 'string',
            'hasil_pelatihan_siswa' => 'string',
            'tingkat_pelatihan_siswa' => 'string',
            'lama_jam_pelatihan_siswa' => 'string',
            // Seminar
            'nomor_seminar' => 'string',
            'nara_sumber' => 'string',
            'materi_seminar' => 'string',
            'tanggal_seminar' => 'string',
            'waktu_seminar' => 'string',
            'tingkat_seminar' => 'string',
            'hasil_seminar' => 'string',
            'keterangan_seminar' => 'string',
            // Piket Gromming
            'piket_gromming' => 'nullable|file',
        ]);

        $fileFields = [
            'tahun_pel',
            'piket_gromming'
        ];

        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            }
        }

        WakaKesiswaan::create($validateData);

        return redirect()->route('waka_kesiswaan.index')->with('success', 'Waka Kesiswaan created successfully.');
    }

    public function edit($id)
    {
        $wakaKesiswaan = WakaKesiswaan::findOrFail($id);
        return view('waka_kesiswaan.edit', compact('wakaKesiswaan'));
    }

    public function update(Request $request, $id)
    {
        $wakaKesiswaan = WakaKesiswaan::findOrFail($id);

        $validateData = $request->validate([
            'tahun_ajaran' => 'required',
            // Buku Penyelesaian Kasus
            'nomor_penyelesaian_kasus' => 'string',
            'nama_penyelesaian_kasus' => 'string',
            'tanggal_kejadian' => 'string',
            'uraian_kasus' => 'string',
            'cara_menyelesaikan' => 'string',
            'tindak_lanjut' => 'string',
            'keterangan_penyelesaian_kasus' => 'string',
            // Buku Hubin
            'nomor_hubin' => 'string',
            'tanggal_kunjungan' => 'string',
            'tempat_kunjungan' => 'string',
            'nama_peserta' => 'string',
            'hasil_kunjungan' => 'string',
            'keterangan_hubin' => 'string',
            // CPD Tahun Pelajaran
            'tahun_pel' => 'nullable|file',
            // Pelatihan Siswa
            'nomor_pelatihan_siswa' => 'string',
            'nama_pelatihan_siswa' => 'string',
            'materi_pelatihan_siswa' => 'string',
            'tempat_pelatihan_siswa' => 'string',
            'tanggal_pelatihan_siswa' => 'string',
            'hasil_pelatihan_siswa' => 'string',
            'tingkat_pelatihan_siswa' => 'string',
            'lama_jam_pelatihan_siswa' => 'string',
            // Seminar
            'nomor_seminar' => 'string',
            'nara_sumber' => 'string',
            'materi_seminar' => 'string',
            'tanggal_seminar' => 'string',
            'waktu_seminar' => 'string',
            'tingkat_seminar' => 'string',
            'hasil_seminar' => 'string',
            'keterangan_seminar' => 'string',
            // Piket Gromming
            'piket_gromming' => 'nullable|file',
        ]);

        $fileFields = [
            'tahun_pel',
            'piket_gromming'
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

        $wakaKesiswaan->update($validateData);

        return redirect()->route('waka_kesiswaan.index')->with('success', 'Waka Kesiswaan updated successfully.');
    }

    public function destroy($id)
    {
        $wakaKesiswaan = WakaKesiswaan::find($id);

        $fileFields = [
            'tahun_pel',
            'piket_gromming'
        ];

        foreach ($fileFields as $fileField) {
            if ($wakaKesiswaan->$fileField) {
                Storage::delete($wakaKesiswaan->$fileField);
            }
        }

        // Hapus data dari database
        $wakaKesiswaan->delete();

        return redirect()->route('waka_kesiswaan.index')
            ->with('success', 'Data Waka Kesiswaan berhasil dihapus.');
    }

    public function downloadFiles($id)
    {
        $wakaKesiswaan = WakaKesiswaan::findOrFail($id);

        $directories = [
            'tahun_pel',
            'piket_gromming'
        ];

        // Create a temporary file to store the zip
        $zipFileName = 'WakaKesiswaan_files_' . $wakaKesiswaan->tahun_ajaran . '.zip';
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
                if ($wakaKesiswaan->$dir) {
                    $filePath = storage_path('app/' . $wakaKesiswaan->$dir);
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
        $data = WakaKesiswaan::findOrFail($id);
        $pdf = PDF::loadView('waka_kesiswaan.pdf', compact('data'));
        return $pdf->download('waka_kesiswaan.pdf');
    }
}
