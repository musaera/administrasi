<x-app-layout>
    <link rel="stylesheet" href="{{ asset('dist/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/demo.min.css') }}">
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.min.js') }}"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="mb-4 col">
                            <a href="{{ route('waka_kurikulum.index') }}" class="btn btn-secondary">
                                Back
                            </a>
                        </div>
                        <form class="card" action="{{ route('waka_kurikulum.update', $wakaKurikulum->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div id="step1">
                                <div class="card-body">
                                    <h3 class="card-title">Edit Waka kurikulum</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tahun Ajaran</label>
                                                <select class="form-control form-select" name="tahun_ajaran">
                                                    <option value="">Pilih Tahun Ajaran</option>
                                                    <option value="2024-2025"
                                                        {{ $wakaKurikulum->tahun_ajaran == '2024-2025' ? 'selected' : '' }}>
                                                        2024-2025</option>
                                                    <option value="2025-2026"
                                                        {{ $wakaKurikulum->tahun_ajaran == '2025-2026' ? 'selected' : '' }}>
                                                        2025-2026</option>
                                                    <option value="2026-2027"
                                                        {{ $wakaKurikulum->tahun_ajaran == '2026-2027' ? 'selected' : '' }}>
                                                        2026-2027</option>
                                                    <option value="2027-2028"
                                                        {{ $wakaKurikulum->tahun_ajaran == '2027-2028' ? 'selected' : '' }}>
                                                        2027-2028</option>
                                                    <option value="2028-2029"
                                                        {{ $wakaKurikulum->tahun_ajaran == '2028-2029' ? 'selected' : '' }}>
                                                        2028-2029</option>
                                                    <option value="2029-2030"
                                                        {{ $wakaKurikulum->tahun_ajaran == '2029-2030' ? 'selected' : '' }}>
                                                        2029-2030</option>
                                                </select>
                                                @error('tahun_ajaran')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step2">
                                <div class="card-body">
                                    <h3 class="card-title">Buku Program Bimbingan</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_bimbingan">Nomor</label>
                                                <input type="text" class="form-control" id="nomor_bimbingan"
                                                    name="nomor_bimbingan"
                                                    value="{{ $wakaKurikulum->nomor_bimbingan }}">
                                                @error('nomor_bimbingan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="waktu_bimbingan">Waktu</label>
                                                <input type="text" class="form-control" id="waktu_bimbingan"
                                                    name="waktu_bimbingan"
                                                    value="{{ $wakaKurikulum->waktu_bimbingan }}">
                                                @error('waktu_bimbingan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_bimbingan">Nama</label>
                                                <input type="text" class="form-control" id="nama_bimbingan"
                                                    name="nama_bimbingan" value="{{ $wakaKurikulum->nama_bimbingan }}">
                                                @error('nama_bimbingan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="kekurangan_bimbingan">Kekurangan</label>
                                                <input type="text" class="form-control" id="kekurangan_bimbingan"
                                                    name="kekurangan_bimbingan"
                                                    value="{{ $wakaKurikulum->kekurangan_bimbingan }}">
                                                @error('kekurangan_bimbingan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="bentuk_bimbingan">Bentuk</label>
                                                <input type="text" class="form-control" id="bentuk_bimbingan"
                                                    name="bentuk_bimbingan"
                                                    value="{{ $wakaKurikulum->bentuk_bimbingan }}">
                                                @error('bentuk_bimbingan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="hasil_bimbingan">Hasil</label>
                                                <input type="text" class="form-control" id="hasil_bimbingan"
                                                    name="hasil_bimbingan"
                                                    value="{{ $wakaKurikulum->hasil_bimbingan }}">
                                                @error('hasil_bimbingan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="keterangan_bimbingan">Keterangan</label>
                                                <textarea class="form-control" id="keterangan_bimbingan" name="keterangan_bimbingan">{{ old('keterangan_bimbingan', $wakaKurikulum->keterangan_bimbingan) }}</textarea>
                                                @error('keterangan_bimbingan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step3">
                                <div class="card-body">
                                    <h3 class="card-title">Buku Capaian Target dan Daya Serap</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_capaian">Nomor</label>
                                                <input type="text" class="form-control" id="nomor_capaian"
                                                    name="nomor_capaian" value="{{ $wakaKurikulum->nomor_capaian }}">
                                                @error('nomor_capaian')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="mapel_capaian">Mapel</label>
                                                <input type="text" class="form-control" id="mapel_capaian"
                                                    name="mapel_capaian" value="{{ $wakaKurikulum->mapel_capaian }}">
                                                @error('mapel_capaian')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="guru_capaian">Guru</label>
                                                <input type="text" class="form-control" id="guru_capaian"
                                                    name="guru_capaian" value="{{ $wakaKurikulum->guru_capaian }}">
                                                @error('guru_capaian')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="target_pencapaian_materi">Target Materi</label>
                                                <input type="text" class="form-control"
                                                    id="target_pencapaian_materi" name="target_pencapaian_materi"
                                                    value="{{ $wakaKurikulum->target_pencapaian_materi }}">
                                                @error('target_pencapaian_materi')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="realisasi_pencapaian">Realisasi</label>
                                                <input type="text" class="form-control" id="realisasi_pencapaian"
                                                    name="realisasi_pencapaian"
                                                    value="{{ $wakaKurikulum->realisasi_pencapaian }}">
                                                @error('realisasi_pencapaian')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="kendala">Kendala</label>
                                                <input type="text" class="form-control" id="kendala"
                                                    name="kendala" value="{{ $wakaKurikulum->kendala }}">
                                                @error('kendala')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="solusi">Solusi</label>
                                                <input type="text" class="form-control" id="solusi"
                                                    name="solusi" value="{{ $wakaKurikulum->solusi }}">
                                                @error('solusi')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="keterangan_capaian">Keterangan</label>
                                                <textarea class="form-control" id="keterangan_capaian" name="keterangan_capaian">{{ old('keterangan_capaian', $wakaKurikulum->keterangan_capaian) }}</textarea>
                                                @error('keterangan_capaian')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step4">
                                <div class="card-body">
                                    <h3 class="card-title">Kenaikan Kelas</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="form-label">Kenaika Kelas X, XI, dan XII</label>
                                                <input type="file" name="kanaikan_kelas" class="form-control"
                                                    value="{{ $wakaKurikulum->kenaikan_kelas }}">
                                                @error('kenaikan_kelas')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button type="button" class="btn btn-secondary" id="prevButton"
                                    style="display: none;">Previous</button>
                                <button type="button" class="btn btn-primary" id="nextButton">Next</button>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = ['step1', 'step2', 'step3', 'step4'];
            let currentStep = 0;

            const nextButton = document.getElementById('nextButton');
            const prevButton = document.getElementById('prevButton');
            const submitButton = document.getElementById('submitButton');

            const toggleVisibility = (element, condition) => {
                element.style.display = condition ? 'none' : 'inline-block';
            };

            const showStep = (step) => {
                steps.forEach((id, index) => {
                    document.getElementById(id).classList.toggle('d-none', index !== step);
                });
                toggleVisibility(prevButton, step === 0);
                toggleVisibility(nextButton, step === steps.length - 1);
                submitButton.classList.toggle('d-none', step !== steps.length - 1);
            };

            nextButton.addEventListener('click', function() {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            prevButton.addEventListener('click', function() {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            showStep(currentStep);
        });
    </script>
</x-app-layout>
