<?php

namespace App\Http\Controllers;

use ZipArchive;
use Illuminate\Http\Request;
use App\Models\WakaKurikulum;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class WakaKurikulumController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranFilter = $request->query('tahun_ajaran', '');

        $query = WakaKurikulum::query();

        if ($tahunAjaranFilter) {
            $query->where('tahun_ajaran', $tahunAjaranFilter);
        }

        $wakaKurikulum = WakaKurikulum::latest()->paginate(10);

        $tahunAjaranOptions = WakaKurikulum::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

        return view('waka_kurikulum.index', compact('wakaKurikulum', 'tahunAjaranOptions', 'tahunAjaranFilter'));
    }

    public function create()
    {
        return view('waka_kurikulum.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tahun_ajaran' => 'required',
            'nomor_bimbingan' => 'string',
            'waktu_bimbingan' => 'string',
            'nama_bimbingan' => 'string',
            'kekurangan_bimbingan' => 'string',
            'bentuk_bimbingan' => 'string',
            'hasil_bimbingan' => 'string',
            'keterangan_bimbingan' => 'string',
            'nomor_capaian' => 'string',
            'mapel_capaian' => 'string',
            'guru_capaian' => 'string',
            'target_pencapaian_materi' => 'string',
            'realisasi_pencapaian' => 'string',
            'kendala' => 'string',
            'solusi' => 'string',
            'keterangan_capaian' => 'string',
            'kenaikan_kelas' => 'nullable|file',
        ]);


        $fileFields = [
            'kenaikan_kelas'
        ];

        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            }
        }

        WakaKurikulum::create($validateData);

        return redirect()->route('waka_kurikulum.index')
            ->with('success', 'Data Waka Kurikulum berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $wakaKurikulum = WakaKurikulum::findOrFail($id);
        return view('waka_kurikulum.edit', compact('wakaKurikulum'));
    }

    public function update(Request $request, $id)
    {
        $wakaKurikulum = WakaKurikulum::findOrFail($id);

        $validateData = $request->validate(
            [
                'tahun_ajaran' => 'required',
                'nomor_bimbingan' => 'string',
                'waktu_bimbingan' => 'string',
                'nama_bimbingan' => 'string',
                'kekurangan_bimbingan' => 'string',
                'bentuk_bimbingan' => 'string',
                'hasil_bimbingan' => 'string',
                'keterangan_bimbingan' => 'string',
                'nomor_capaian' => 'string',
                'mapel_capaian' => 'string',
                'guru_capaian' => 'string',
                'target_pencapaian_materi' => 'string',
                'realisasi_pencapaian' => 'string',
                'kendala' => 'string',
                'solusi' => 'string',
                'keterangan_capaian' => 'string',
                'kenaikan_kelas' => 'nullable|file',
            ]
        );

        $fileFields = [
            'kenaikan_kelas',
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

        $wakaKurikulum->update($validateData);

        return redirect()->route('waka_kurikulum.index')
            ->with('success', 'Data Waka Kurikulum berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $wakaKurikulum = WakaKurikulum::find($id);

        $fileFields = [
            'kenaikan_kelas',
        ];

        foreach ($fileFields as $fileField) {
            if ($wakaKurikulum->$fileField) {
                Storage::delete($wakaKurikulum->$fileField);
            }
        }

        // Hapus data dari database
        $wakaKurikulum->delete();

        return redirect()->route('waka_kurikulum.index')
            ->with('success', 'Data Waka Kurikulum berhasil dihapus.');
    }

    public function exportPDF($id)
    {
        $data = WakaKurikulum::findOrFail($id);
        $pdf = Pdf::loadView('waka_kurikulum.pdf', compact('data'));
        return $pdf->download('waka_kurikulum.pdf');
    }

    public function downloadFiles($id)
    {
        $wakaKurikulum = WakaKurikulum::findOrFail($id);

        $directories = [
            'kenaikan_kelas'
        ];

        // Create a temporary file to store the zip
        $zipFileName = 'WakaKurikulum_files_' . $wakaKurikulum->tahun_ajaran . '.zip';
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
                if ($wakaKurikulum->$dir) {
                    $filePath = storage_path('app/' . $wakaKurikulum->$dir);
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
}
