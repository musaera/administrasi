<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Osis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OsisController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranFilter = $request->query('tahun_ajaran', '');

        $query = Osis::query();

        if ($tahunAjaranFilter) {
            $query->where('tahun_ajaran', $tahunAjaranFilter);
        }

        $osis = Osis::latest()->paginate(10);

        $tahunAjaranOptions = Osis::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

        return view('osis.index', compact('osis', 'tahunAjaranFilter', 'tahunAjaranOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('osis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
                'tahun_ajaran' => 'required',
                'struktur_organisasi' => 'nullable|file',
                'pengurus' => 'nullable|file',
                'program' => 'nullable|file',
                'pelaksanaan_dan_dokumentasi' => 'nullable|file',
            ],
            [
                'tahun_ajaran' => 'Tahun ajaran harus diisi'
            ]
        );

        $fileFields = [
            'struktur_organisasi',
            'pengurus',
            'program',
            'pelaksanaan_dan_dokumentasi',
        ];

        foreach ($fileFields as $fileField) {
            if ($request->file($fileField)) {
                $file = $request->file($fileField);
                $originalName = $file->getClientOriginalName();
                $validateData[$fileField] = $file->storeAs($fileField, $originalName);
            }
        }

        Osis::create($validateData);

        return redirect()->route('osis.index')->with('success', 'Osis created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $osis = Osis::findOrFail($id);
        return view('osis.edit', compact('osis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $osis = Osis::findOrFail($id);

        $validateData = $request->validate(
            [
                'tahun_ajaran' => 'required',
                'struktur_organisasi' => 'nullable|file',
                'pengurus' => 'nullable|file',
                'program' => 'nullable|file',
                'pelaksanaan_dan_dokumentasi' => 'nullable|file',
            ],
            [
                'tahun_ajaran' => 'Tahun ajaran harus diisi'
            ]
        );

        $fileFields = [
            'struktur_organisasi', 'pengurus', 'program', 'pelaksana_dan_dokumentasi'
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

        $osis->update($validateData);

        return redirect()->route('osis.index')->with('success', 'Osis updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $osis = Osis::findOrFail($id);

        $fileFields = [
            'struktur_organisasi', 'pengurus', 'program', 'pelaksanaan_dan_dokumentasi'
        ];

        foreach ($fileFields as $fileField) {
            if ($osis->$fileField) {
                Storage::delete($osis->$fileField);
            }
        }

        $osis->delete();

        return redirect()->route('osis.index')->with('success', 'Osis deleted successfully.');
    }

    public function downloadFiles($id)
    {
        $osis = Osis::findOrFail($id);

        $directories = [
            'struktur_organisasi', 'pengurus', 'program', 'pelaksanaan_dan_dokumentasi'
        ];

        // Create a temporary file to store the zip
        $zipFileName = 'Osis_files_' . $osis->tahun_ajaran . '.zip';
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
                if ($osis->$dir) {
                    $filePath = storage_path('app/' . $osis->$dir);
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
