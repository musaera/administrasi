<x-app-layout>
    <link rel="stylesheet" href="{{ asset('dist/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/demo.min.css') }}">
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.min.js') }}"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between p-4">
                <a href="{{ route('administrasiKeguruan') }}" class="btn btn-primary">
                    Back
                </a>
                <a href="{{ route('mapel.create') }}" class="btn btn-primary">
                    Add Data Mata Pelajaran
                </a>
            </div>
            <div class="col flex flex-wrap justify-center">
                <a href="{{ route('mapel.index') }}" class="btn btn-secondary mb-3 ">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('mapel.index') }}" class="mb-3 flex flex-wrap justify-center gap-4">

                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran:</label>
                        <select id="tahun_ajaran" name="tahun_ajaran" class="form-control"
                            onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach ($tahunAjaranOptions as $option)
                                <option value="{{ $option }}"
                                    {{ $tahunAjaranFilter == $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <select id="kelas" name="kelas" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach ($kelasOptions as $option)
                                <option value="{{ $option }}" {{ $kelasFilter == $option ? 'selected' : '' }}>
                                    {{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="mapel">Mapel:</label>
                        <select id="mapel" name="mapel" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach ($mapelOptions as $option)
                                <option value="{{ $option }}" {{ $mapelFilter == $option ? 'selected' : '' }}>
                                    {{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h1 class="card-title">Daftar Mata Pelajaran</h1>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Kelas</th>
                                            <th>Mapel</th>
                                            <th>Kategori Kurikulum</th>
                                            <th>RPP</th>
                                            <th>Silabus</th>
                                            <th>KI KD & SKL</th>
                                            <th>Kode Etik</th>
                                            <th>Program Semester</th>
                                            <th>Program Tahunan</th>
                                            <th>Kaldik Sekolah</th>
                                            <th>JAK</th>
                                            <th>Analisi Waktu</th>
                                            <th>Daftar Hadir Siswa</th>
                                            <th>Jadwal Pelajaran</th>
                                            <th>Kisi-kisi, Soal, Kartu Soal</th>
                                            <th>PKG</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mapels as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tahun_ajaran }}</td>
                                                <td>{{ $item->kelas }}</td>
                                                <td>{{ $item->mapel }}</td>
                                                <td>{{ $item->kategori_kurikulum }}</td>
                                                <td>{{ Str::limit($item->rpp, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->silabus, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->ki_kd_skl, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->kode_etik, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->program_semester, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->program_tahunan, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->kaldik_sekolah, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->jak, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->analisi_waktu, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->daftar_hadir_siswa, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->jadwal_pelajaran, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->kisi_kisi_soal_kartu_soal, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->pkg, 10, '...') }}</td>
                                                <td>
                                                    <a href="{{ route('mapel.download', $item->id) }}"
                                                        class="btn btn-info">Download</a>
                                                    <a href="{{ route('mapel.edit', $item->id) }}"
                                                        class="btn btn-secondary">Edit</a>
                                                    <form action="{{ route('mapel.destroy', $item->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $mapels->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
