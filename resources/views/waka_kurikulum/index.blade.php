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
                <a href="{{ route('waka_kurikulum.create') }}" class="btn btn-primary">
                    Add Data Waka Kurikulum
                </a>
            </div>
            <div class="col flex flex-wrap justify-center">
                <a href="{{ route('waka_kurikulum.index') }}" class="btn btn-secondary mb-3 ">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('waka_kurikulum.index') }}" class="mb-3 flex flex-wrap justify-center gap-4">
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
                                <h3 class="card-title">Daftar Waka Kurikulum</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Nomor Bimbingan</th>
                                                <th>Waktu Bimbingan</th>
                                                <th>Nama Bimbingan</th>
                                                <th>Kekurangan Bimbingan</th>
                                                <th>Bentuk Bimbingan</th>
                                                <th>Hasil Bimbingan</th>
                                                <th>Keterangan Bimbingan</th>
                                                <th>Nomor Capaian</th>
                                                <th>Mapel Capaian</th>
                                                <th>Guru Capaian</th>
                                                <th>Target Pencapaian Materi</th>
                                                <th>Realisasi Capaian</th>
                                                <th>Kendala Capaian</th>
                                                <th>Solusi Capaian</th>
                                                <th>Keterangan Capaian</th>
                                                <th>Kenaikan Kelas</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($wakaKurikulum as $key => $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->tahun_ajaran }}</td>
                                                    <td>{{ $data->nomor_bimbingan }}</td>
                                                    <td>{{ $data->waktu_bimbingan }}</td>
                                                    <td>{{ $data->nama_bimbingan }}</td>
                                                    <td>{{ Str::limit($data->kekurangan_bimbingan, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->bentuk_bimbingan, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->hasil_bimbingan, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->keterangan_bimbingan, 10, '...') }}</td>
                                                    <td>{{ $data->nomor_capaian }}</td>
                                                    <td>{{ $data->mapel_capaian }}</td>
                                                    <td>{{ $data->guru_capaian }}</td>
                                                    <td>{{ Str::limit($data->target_pencapaian_materi, 10, '...') }}
                                                    </td>
                                                    <td>{{ Str::limit($data->realisasi_pencapaian, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->kendala, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->solusi, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->keterangan_capaian, 10, '...') }}</td>
                                                    <td>{{ Str::limit($data->kenaikan_kelas, 10, '...') }}</td>
                                                    <td>
                                                        <a href="{{ route('waka_kurikulum.edit', $data->id) }}"
                                                            class="btn btn-sm btn-primary">Edit</a>

                                                        <form action="{{ route('waka_kurikulum.destroy', $data->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                        @if ($data->kenaikan_kelas)
                                                            <a href="{{ route('waka_kurikulum.downloadFile', $data->id) }}"
                                                                class="btn btn-sm btn-info">Download</a>
                                                        @else
                                                            No File
                                                        @endif
                                                        <a href="{{ route('waka_kurikulum.exportPDF', $data->id) }}"
                                                            class="btn btn-sm btn-danger">Export PDF</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="19" class="text-center">No data available</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                {{ $wakaKurikulum->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
