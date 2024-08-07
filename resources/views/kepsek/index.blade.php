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
                <a href="{{ route('kepsek.create') }}" class="btn btn-primary">
                    Add Data Kepsek
                </a>
            </div>
            <div class="col flex flex-wrap justify-center">
                <a href="{{ route('kepsek.index') }}" class="btn btn-secondary mb-3 ">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('kepsek.index') }}" class="mb-3 flex flex-wrap justify-center gap-4">
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
            </form>
            <div class="col">
                <div class="row row-card">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Daftar kepsek</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Proker</th>
                                                <th>RKTS</th>
                                                <th>RKJM</th>
                                                <th>Prog. Jangka Panjang</th>
                                                <th>RAPBS</th>
                                                <th>Nomor Penilaian</th>
                                                <th>Nama Guru</th>
                                                <th>Nilai Tepat Waktu</th>
                                                <th>Penilaian Kumulatif Siswa</th>
                                                <th>Capaian Materi</th>
                                                <th>Prestasi</th>
                                                <th>Bulan</th>
                                                <th>keterangan</th>
                                                <th>Nomor Pembagian</th>
                                                <th>Nama Pembagian</th>
                                                <th>Kelas</th>
                                                <th>Jabatan</th>
                                                <th>Mapel</th>
                                                <th>Jumlah Jp</th>
                                                <th>Keterangan Pembagian</th>
                                                <th>Option</th>
                                        </thead>
                                        <tbody>
                                            @forelse ($kepsek as $key => $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->tahun_ajaran }}</td>
                                                    <td>{{ Str::limit($data->proker_kepsek, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->rkts, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->rkjm, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->prog_jangka_panjang, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->rapbs, 10, '...') }}</td>
                                                    <td>{{ $data->nomor_penilaian }}</td>
                                                    <td>{{ $data->nama_guru }}</td>
                                                    <td>{{ $data->nilai_tepat_waktu }}</td>
                                                    <td>{{ Str::limit($data->penilaian_kumulatif_siswa, 10, '...') }}
                                                    </td>
                                                    <td>{{ Str::limit($data->capaian_materi, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->prestasi, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->bulan, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->keterangan_penilaian_bulanan, 10, '...') }}
                                                    </td>
                                                    <td>{{ $data->nomor_pembagian_tugas }}</td>
                                                    <td>{{ $data->nama_pembagian_tugas }}</td>
                                                    <td>{{ $data->kelas }}</td>
                                                    <td>{{ $data->jabatan }}</td>
                                                    <td>{{ $data->mapel }}</td>
                                                    <td>{{ $data->jumlah_jp }}</td>
                                                    <td>{{ Str::limit($data->keterangan_pembagian_tugas, 10, '...') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('kepsek.download', $data->id) }}"
                                                            class="btn btn-info">Download</a>
                                                        <a href="{{ route('kepsek.exportPDF', $data->id) }}"
                                                            class="btn btn-danger">Export</a>
                                                        <a href="{{ route('kepsek.edit', $data->id) }}"
                                                            class="btn btn-primary">Edit</a>
                                                        <form action="{{ route('kepsek.destroy', $data->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="18" class="text-center">No data available</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                {{ $kepsek->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
