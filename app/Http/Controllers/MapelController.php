<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranFilter = $request->query('tahun_ajaran', '');
        $kelasFilter = $request->query('kelas', '');
        $mapelFilter = $request->query('mapel', '');

        $query = Mapel::query();

        if ($tahunAjaranFilter) {
            $query->where('tahun_ajaran', $tahunAjaranFilter);
        }

        if ($kelasFilter) {
            $query->where('kelas', $kelasFilter);
        }

        if ($mapelFilter) {
            $query->where('mapel', $mapelFilter);
        }

        $mapels = $query->paginate(10);

        $tahunAjaranOptions = Mapel::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');
        $kelasOptions = Mapel::select('kelas')->distinct()->pluck('kelas');
        $mapelOptions = Mapel::select('mapel')->distinct()->pluck('mapel');

        return view('mapel.index', compact('mapels', 'tahunAjaranFilter', 'kelasFilter', 'mapelFilter', 'tahunAjaranOptions', 'kelasOptions', 'mapelOptions'));
    }


    public function create()
    {
        return view('mapel.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validateData = $request->validate([
            'tahun_ajaran' => 'required',
            'kelas' => 'required',
            'mapel' => 'required',
            'kategori_kurikulum' => 'required',
            'rpp.*' => 'nullable|file',
            'silabus' => 'nullable|file',
            'ki_kd_skl' => 'nullable|file',
            'kode_etik' => 'nullable|file',
            'program_semester' => 'nullable|file',
            'program_tahunan' => 'nullable|file',
            'kaldik_sekolah' => 'nullable|file',
            'jak' => 'nullable|file',
            'analisi_waktu' => 'nullable|file',
            'daftar_hadir_siswa' => 'nullable|file',
            'jadwal_pelajaran' => 'nullable|file',
            'kisi_kisi_soal_kartu_soal' => 'nullable|file',
            'pkg' => 'nullable|file',
        ], [
            'tahun_ajaran.required' => 'Tahun ajaran harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'mapel.required' => 'Mapel harus diisi',
            'kategori_kurikulum.required' => 'Kategori harus diisi',
        ]);

        $fileFields = [
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

        foreach ($fileFields as $fileField) {
            if ($fileField === 'rpp' && $request->hasFile($fileField)) {
                $rppFiles = [];
                foreach ($request->file($fileField) as $file) {
                    $originalName = $file->getClientOriginalName();
                    $rppFiles[] = $file->storeAs($fileField, $originalName);
                }
                $validateData[$fileField] = json_encode($rppFiles); // Simpan sebagai JSON
            } elseif ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            }
        }

        // Simpan data ke database
        Mapel::create($validateData);

        return redirect()->route('mapel.index')->with('success', 'Mapel created successfully.');
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        $rppFiles = Storage::files('rpp');

        return view('mapel.edit', compact('mapel', 'rppFiles'));
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);

        $validateData = $request->validate(
            [
                'tahun_ajaran' => 'required',
                'kelas' => 'required',
                'mapel' => 'required',
                'kategori_kurikulum' => 'required',
                'rpp.*' => 'nullable|file',
                'silabus' => 'nullable|file',
                'ki_kd_skl' => 'nullable|file',
                'kode_etik' => 'nullable|file',
                'program_semester' => 'nullable|file',
                'program_tahunan' => 'nullable|file',
                'kaldik_sekolah' => 'nullable|file',
                'jak' => 'nullable|file',
                'analisi_waktu' => 'nullable|file',
                'daftar_hadir_siswa' => 'nullable|file',
                'jadwal_pelajaran' => 'nullable|file',
                'kisi_kisi_soal_kartu_soal' => 'nullable|file',
                'pkg' => 'nullable|file',
            ],
            [
                'tahun_ajaran.required' => 'Tahun ajaran harus diisi',
                'kelas.required' => 'Kelas harus diisi',
                'mapel.required' => 'Mapel harus diisi',
                'kategori_kurikulum.required' => 'Kategori harus diisi',
            ]
        );

        // Menyimpan file-file yang di-upload di folder mapel
        $fileFields = [
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

        foreach ($fileFields as $fileField) {
            if ($fileField === 'rpp' && $request->hasFile($fileField)) {
                $rppFiles = [];
                foreach ($request->file($fileField) as $file) {
                    $originalName = $file->getClientOriginalName();
                    $rppFiles[] = $file->storeAs($fileField, $originalName);
                }
                $validateData[$fileField] = json_encode($rppFiles); // Simpan sebagai JSON
            } elseif ($request->hasFile($fileField)) {
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

        $mapel->update($validateData);

        return redirect()->route('mapel.index')->with('success', 'Mapel updated successfully.');
    }

    public function destroy($id)
    {
        // Temukan mapel berdasarkan ID
        $mapel = Mapel::findOrFail($id);

        // Define file fields
        $fileFields = [
            'rpp', 'silabus', 'ki_kd_skl', 'kode_etik', 'program_semester',
            'program_tahunan', 'kaldik_sekolah', 'jak', 'analisi_waktu',
            'daftar_hadir_siswa', 'jadwal_pelajaran', 'kisi_kisi_soal_kartu_soal', 'pkg'
        ];

        foreach ($fileFields as $fileField) {
            if ($mapel->$fileField) {
                if ($fileField === 'rpp') {
                    // Handle JSON formatted data for rpp
                    $files = json_decode($mapel->$fileField, true);
                    if (is_array($files)) {
                        foreach ($files as $file) {
                            Storage::delete($file); // Delete each file listed in the JSON
                        }
                    }
                } else {
                    // Handle individual files
                    Storage::delete($mapel->$fileField); // Delete the single file
                }
            }
        }

        // Hapus entri dari database
        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Mapel deleted successfully.');
    }

    public function downloadFiles($id)
    {
        $mapel = Mapel::findOrFail($id);

        $directories = [
            'rpp', 'silabus', 'ki_kd_skl', 'kode_etik',
            'program_semester', 'program_tahunan', 'kaldik_sekolah',
            'jak', 'analisi_waktu', 'daftar_hadir_siswa',
            'jadwal_pelajaran', 'kisi_kisi_soal_kartu_soal', 'pkg'
        ];

        // Create a temporary file to store the zip
        $zipFileName = 'Mapel_files_' . $mapel->mapel . '.zip';
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
                if ($mapel->$dir) {
                    $files = json_decode($mapel->$dir);
                    if (is_array($files)) {
                        foreach ($files as $file) {
                            $filePath = storage_path('app/' . $file);
                            if (file_exists($filePath)) {
                                $zip->addFile($filePath, $dir . '/' . basename($filePath));
                            }
                        }
                    } else {
                        $filePath = storage_path('app/' . $mapel->$dir);
                        if (file_exists($filePath)) {
                            $zip->addFile($filePath, $dir . '/' . basename($filePath));
                        }
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
