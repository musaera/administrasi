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
                <a href="{{ route('kepalaLabKom.create') }}" class="btn btn-primary">
                    Add Data Kepala LABKOM
                </a>
            </div>
            <div class="col flex flex-wrap justify-center">
                <a href="{{ route('kepalaLabKom.index') }}" class="btn btn-secondary mb-3 ">Reset Filters</a>
            </div>
            <form method="GET" action="{{ route('kepalaLabKom.index') }}"
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
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Daftar Kepala Lab. Komputer</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Tatib</th>
                                            <th>Denah</th>
                                            <th>Data Lab</th>
                                            <th>Data Pengguna</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($kepalaLabKom as $item)
                                            <tr>
                                                <td>
                                                    {{ $i++ }}
                                                </td>
                                                <td>{{ $item->tahun_ajaran }}</td>
                                                <td>{{ Str::limit($item->tatib_lab, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->denah_lab, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->data_lab, 10, '...') }}</td>
                                                <td>{{ Str::limit($item->data_pengguna, 10, '...') }}</td>
                                                <td>
                                                    <a href="{{ route('kepalaLabKom.download', $item->id) }}"
                                                        class="btn btn-info">Download</a>
                                                    <a href="{{ route('kepalaLabKom.edit', $item->id) }}"
                                                        class="btn btn-secondary">Edit</a>
                                                    <form action="{{ route('kepalaLabKom.destroy', $item->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $kepalaLabKom->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
