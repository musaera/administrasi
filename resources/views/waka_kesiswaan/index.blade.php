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
                <a href="{{ route('waka_kesiswaan.create') }}" class="btn btn-primary">
                    Add Data Waka Kesiswaan
                </a>
            </div>
            <div class="col flex flex-wrap justify-center">
                <a href="{{ route('waka_kesiswaan.index') }}" class="btn btn-secondary mb-3 ">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('waka_kesiswaan.index') }}"
                class="mb-3 flex flex-wrap justify-center gap-4">
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
                                <h3 class="card-title">Daftar Waka Kesiswaan</h3>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Nomor</th>
                                                <th>Nama</th>
                                                <th>Tanggal Kejadian</th>
                                                <th>Uraian Kasus</th>
                                                <th>Cara Menyelesaiakan</th>
                                                <th>Tindak Lanjut</th>
                                                <th>Keterangan</th>
                                                <th>Nomor</th>
                                                <th>Tanggal Kunjungan</th>
                                                <th>Tempat Kunjungan</th>
                                                <th>Nama Peserta</th>
                                                <th>Hasil Kunjungan</th>
                                                <th>Keterangan</th>
                                                <th>Tahun Pel</th>
                                                <th>Nomor</th>
                                                <th>Nama</th>
                                                <th>Materi</th>
                                                <th>Tempat</th>
                                                <th>Tanggal</th>
                                                <th>Hasil</th>
                                                <th>Tingkat</th>
                                                <th>Lama dalam Jam</th>
                                                <th>Nomor</th>
                                                <th>Narasumber</th>
                                                <th>Materi</th>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                                <th>Tingkat</th>
                                                <th>Hasil</th>
                                                <th>Keterangan</th>
                                                <th>Piket Gromming</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($wakaKesiswaan as $key => $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->tahun_ajaran }}</td>
                                                    <td>{{ $data->nomor_penyelesaian_kasus }}</td>
                                                    <td>{{ $data->nama_penyelesaian_kasus }}</td>
                                                    <td>{{ $data->tanggal_kejadian }}</td>
                                                    <td>{{ Str::limit($data->uraian_kasus, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->cara_menyelesaikan, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->tindak_lanjut, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->keterangan_penyelesaian_kasus, 10, '...') }}
                                                    </td>
                                                    <td>{{ $data->nomor_hubin }}</td>
                                                    <td>{{ $data->tanggal_kunjungan }}</td>
                                                    <td>{{ $data->tempat_kunjungan }}</td>
                                                    <td>{{ $data->nama_peserta }}</td>
                                                    <td>{{ Str::limit($data->hasil_kunjungan, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->keterangan_hubin, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->tahun_pel, 10, '...') }}</td>
                                                    <td>{{ $data->nomor_pelatihan_siswa }}</td>
                                                    <td>{{ $data->nama_pelatihan_siswa }}</td>
                                                    <td>{{ $data->materi_pelatihan_siswa }}</td>
                                                    <td>{{ $data->tempat_pelatihan_siswa }}</td>
                                                    <td>{{ $data->tanggal_pelatihan_siswa }}</td>
                                                    <td>{{ Str::limit($data->hasil_pelatihan_siswa, 10, '...') }}</td>
                                                    <td>{{ $data->tingkat_pelatihan_siswa }}</td>
                                                    <td>{{ $data->lama_jam_pelatihan_siswa }}</td>
                                                    <td>{{ $data->nomor_seminar }}</td>
                                                    <td>{{ $data->nara_sumber }}</td>
                                                    <td>{{ $data->materi_seminar }}</td>
                                                    <td>{{ $data->tanggal_seminar }}</td>
                                                    <td>{{ $data->waktu_seminar }}</td>
                                                    <td>{{ $data->tingkat_seminar }}</td>
                                                    <td>{{ Str::limit($data->hasil_seminar, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->keterangan_seminar, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->piket_gromming, 10, '...') }}</td>
                                                    <td>
                                                        <a href="{{ route('waka_kesiswaan.download', $data->id) }}"
                                                            class="btn btn-info">Download</a>
                                                        <a href="{{ route('waka_kesiswaan.exportPDF', $data->id) }}"
                                                            class="btn btn-danger">Export</a>
                                                        <a href="{{ route('waka_kesiswaan.edit', $data->id) }}"
                                                            class="btn btn-primary">Edit</a>
                                                        <form action="{{ route('waka_kesiswaan.destroy', $data->id) }}"
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
                                {{ $wakaKesiswaan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
