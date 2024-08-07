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
                <a href="{{ route('walas.create') }}" class="btn btn-primary">
                    Add Data Wali Kelas
                </a>
            </div>
            <div class="col flex flex-wrap justify-center">
                <a href="{{ route('walas.index') }}" class="btn btn-secondary mb-3">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('walas.index') }}" class="mb-3 flex flex-wrap justify-center gap-4">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran:</label>
                        <select id="tahun_ajaran" name="tahun_ajaran" class="form-control"
                            onchange="this.form.submit()">
                            <option value="">Semua</option>
                            @foreach ($tahunAjaranOptions as $option)
                                <option value="{{ $option }}"
                                    {{ $tahunAjaranFilter == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
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
                                <h3 class="card-title">Daftar Wali Kelas</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Penyerahan Rapor</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($walas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tahun_ajaran }}</td>
                                                <td>{{ Str::limit($item->penyerahan_rapor, 10, '...') }}</td>
                                                <td>
                                                    <a href="{{ route('walas.downloadFile', $item->id) }}"
                                                        class="btn btn-info">Download</a>
                                                    <a href="{{ route('walas.edit', $item->id) }}"
                                                        class="btn btn-secondary">Edit</a>
                                                    <form action="{{ route('walas.destroy', $item->id) }}"
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
                                {{ $walas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
