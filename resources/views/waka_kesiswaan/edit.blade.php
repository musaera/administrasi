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
                            <a href="{{ route('waka_kesiswaan.index') }}" class="btn btn-secondary">
                                Back
                            </a>
                        </div>
                        <form class="card" action="{{ route('waka_kesiswaan.update', $wakaKesiswaan->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div id="step1">
                                <div class="card-body">
                                    <h3 class="card-title">Edit Waka kesiswaan</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tahun Ajaran</label>
                                                <select class="form-control form-select" name="tahun_ajaran">
                                                    <option value="">Pilih Tahun Ajaran</option>
                                                    <option value="2024-2025"
                                                        {{ $wakaKesiswaan->tahun_ajaran == '2024-2025' ? 'selected' : '' }}>
                                                        2024-2025</option>
                                                    <option value="2025-2026"
                                                        {{ $wakaKesiswaan->tahun_ajaran == '2025-2026' ? 'selected' : '' }}>
                                                        2025-2026</option>
                                                    <option value="2026-2027"
                                                        {{ $wakaKesiswaan->tahun_ajaran == '2026-2027' ? 'selected' : '' }}>
                                                        2026-2027</option>
                                                    <option value="2027-2028"
                                                        {{ $wakaKesiswaan->tahun_ajaran == '2027-2028' ? 'selected' : '' }}>
                                                        2027-2028</option>
                                                    <option value="2028-2029"
                                                        {{ $wakaKesiswaan->tahun_ajaran == '2028-2029' ? 'selected' : '' }}>
                                                        2028-2029</option>
                                                    <option value="2029-2030"
                                                        {{ $wakaKesiswaan->tahun_ajaran == '2029-2030' ? 'selected' : '' }}>
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
                                    <h3 class="card-title">Buku Penyelesaian Kasus</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_penyelesaian_kasus">Nomor</label>
                                                <input type="text" class="form-control" id="nomor_penyelesaian_kasus"
                                                    name="nomor_penyelesaian_kasus"
                                                    value="{{ $wakaKesiswaan->nomor_penyelesaian_kasus }}">
                                                @error('nomor_penyelesaian_kasus')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_penyelesaian_kasus">Nama Kasus</label>
                                                <input type="text" class="form-control" id="nama_penyelesaian_kasus"
                                                    name="nama_penyelesaian_kasus"
                                                    value="{{ $wakaKesiswaan->nama_penyelesaian_kasus }}">
                                                @error('nama_penyelesaian_kasus')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tanggal_kejadian">Tanggal</label>
                                                <input type="text" class="form-control" id="tanggal_kejadian"
                                                    name="tanggal_kejadian"
                                                    value="{{ $wakaKesiswaan->tanggal_kejadian }}">
                                                @error('tanggal_kejadian')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="uraian_kasus">Uraian Kasus</label>
                                                <input type="text" class="form-control" id="uraian_kasus"
                                                    name="uraian_kasus" value="{{ $wakaKesiswaan->uraian_kasus }}">
                                                @error('uraian_kasus')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="cara_menyelesaikan">Cara Menyelesaikan</label>
                                                <input type="text" class="form-control" id="cara_menyelesaikan"
                                                    name="cara_menyelesaikan"
                                                    value="{{ $wakaKesiswaan->cara_menyelesaikan }}">
                                                @error('cara_menyelesaikan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tindak_lanjut">Tindak Lanjut</label>
                                                <input type="text" class="form-control" id="tindak_lanjut"
                                                    name="tindak_lanjut" value="{{ $wakaKesiswaan->tindak_lanjut }}">
                                                @error('tindak_lanjut')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="keterangan_penyelesaian_kasus">Keterangan</label>
                                                <input type="text" class="form-control"
                                                    id="keterangan_penyelesaian_kasus"
                                                    name="keterangan_penyelesaian_kasus"
                                                    value="{{ $wakaKesiswaan->keterangan_penyelesaian_kasus }}">
                                                @error('keterangan_penyelesaian_kasus')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step3">
                                <div class="card-body">
                                    <h3 class="card-title">Buku Hubin</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_hubin">Nomor</label>
                                                <input type="text" class="form-control" id="nomor_hubin"
                                                    name="nomor_hubin" value="{{ $wakaKesiswaan->nomor_hubin }}">
                                                @error('nomor_hubin')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                                                <input type="text" class="form-control" id="tanggal_kunjungan"
                                                    name="tanggal_kunjungan"
                                                    value="{{ $wakaKesiswaan->tanggal_kunjungan }}">
                                                @error('tanggal_kunjungan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tempat_kunjungan">Tempat Kunjungan</label>
                                                <input type="text" class="form-control" id="tempat_kunjungan"
                                                    name="tempat_kunjungan"
                                                    value="{{ $wakaKesiswaan->tempat_kunjungan }}">
                                                @error('tempat_kunjungan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_peserta">Nama Peserta</label>
                                                <input type="text" class="form-control" id="nama_peserta"
                                                    name="nama_peserta" value="{{ $wakaKesiswaan->nama_peserta }}">
                                                @error('nama_peserta')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="hasil_kunjungan">Hasil Kunjungan</label>
                                                <input type="text" class="form-control" id="hasil_kunjungan"
                                                    name="hasil_kunjungan"
                                                    value="{{ $wakaKesiswaan->hasil_kunjungan }}">
                                                @error('hasil_kunjungan')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="keterangan_hubin">Keterangan</label>
                                                <input type="text" class="form-control" id="keterangan_hubin"
                                                    name="keterangan_hubin"
                                                    value="{{ $wakaKesiswaan->keterangan_hubin }}">
                                                @error('keterangan_hubin')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step4">
                                <div class="card-body">
                                    <h3 class="card-title">CPD Tahun Pelajaran</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="form-label">Tahun Pel</label>
                                                <input type="file" name="tahun_pel" class="form-control"
                                                    value="{{ $wakaKesiswaan->tahun_pel }}">
                                                @error('tahun_pel')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                                @if ($wakaKesiswaan->tahun_pel)
                                                    <p>{{ basename($wakaKesiswaan->tahun_pel) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step5">
                                <div class="card-body">
                                    <h3 class="card-title">Pelatihan Siswa</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_pelatihan_siswa">Nomor</label>
                                                <input type="text" class="form-control" id="nomor_pelatihan_siswa"
                                                    name="nomor_pelatihan_siswa"
                                                    value="{{ $wakaKesiswaan->nomor_pelatihan_siswa }}">
                                                @error('nomor_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nama_pelatihan_siswa">Nama</label>
                                                <input type="text" class="form-control" id="nama_pelatihan_siswa"
                                                    name="nama_pelatihan_siswa"
                                                    value="{{ $wakaKesiswaan->nama_pelatihan_siswa }}">
                                                @error('nama_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="materi_pelatihan_siswa">Materi</label>
                                                <input type="text" class="form-control"
                                                    id="materi_pelatihan_siswa" name="materi_pelatihan_siswa"
                                                    value="{{ $wakaKesiswaan->materi_pelatihan_siswa }}">
                                                @error('materi_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tempat_pelatihan_siswa">Tempat</label>
                                                <input type="text" class="form-control"
                                                    id="tempat_pelatihan_siswa" name="tempat_pelatihan_siswa"
                                                    value="{{ $wakaKesiswaan->tempat_pelatihan_siswa }}">
                                                @error('tempat_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tanggal_pelatihan_siswa">Tanggal</label>
                                                <input type="text" class="form-control"
                                                    id="tanggal_pelatihan_siswa" name="tanggal_pelatihan_siswa"
                                                    value="{{ $wakaKesiswaan->tanggal_pelatihan_siswa }}">
                                                @error('tanggal_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="hasil_pelatihan_siswa">Hasil</label>
                                                <input type="text" class="form-control" id="hasil_pelatihan_siswa"
                                                    name="hasil_pelatihan_siswa"
                                                    value="{{ $wakaKesiswaan->hasil_pelatihan_siswa }}">
                                                @error('hasil_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tingkat_pelatihan_siswa">Tingkat</label>
                                                <input type="text" class="form-control"
                                                    id="tingkat_pelatihan_siswa" name="tingkat_pelatihan_siswa"
                                                    value="{{ $wakaKesiswaan->tingkat_pelatihan_siswa }}">
                                                @error('tingkat_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="lama_jam_pelatihan_siswa">Lama dalam Jam</label>
                                                <input type="text" class="form-control"
                                                    id="lama_jam_pelatihan_siswa" name="lama_jam_pelatihan_siswa"
                                                    value="{{ $wakaKesiswaan->lama_jam_pelatihan_siswa }}">
                                                @error('lama_jam_pelatihan_siswa')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step6">
                                <div class="card-body">
                                    <h3 class="card-title">Seminar</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nomor_seminar">Nomor</label>
                                                <input type="text" class="form-control" id="nomor_seminar"
                                                    name="nomor_seminar" value="{{ $wakaKesiswaan->nomor_seminar }}">
                                                @error('nomor_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="nara_sumber">Narasumber</label>
                                                <input type="text" class="form-control" id="nara_sumber"
                                                    name="nara_sumber" value="{{ $wakaKesiswaan->nara_sumber }}">
                                                @error('nara_sumber')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="materi_seminar">Materi</label>
                                                <input type="text" class="form-control" id="materi_seminar"
                                                    name="materi_seminar"
                                                    value="{{ $wakaKesiswaan->materi_seminar }}">
                                                @error('materi_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tanggal_seminar">Tanggal</label>
                                                <input type="text" class="form-control" id="tanggal_seminar"
                                                    name="tanggal_seminar"
                                                    value="{{ $wakaKesiswaan->tanggal_seminar }}">
                                                @error('tanggal_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="waktu_seminar">Waktu</label>
                                                <input type="text" class="form-control" id="waktu_seminar"
                                                    name="waktu_seminar" value="{{ $wakaKesiswaan->waktu_seminar }}">
                                                @error('waktu_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="tingkat_seminar">Tingkat</label>
                                                <input type="text" class="form-control" id="tingkat_seminar"
                                                    name="tingkat_seminar"
                                                    value="{{ $wakaKesiswaan->tingkat_seminar }}">
                                                @error('tingkat_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="hasil_seminar">Hasil</label>
                                                <input type="text" class="form-control" id="hasil_seminar"
                                                    name="hasil_seminar" value="{{ $wakaKesiswaan->hasil_seminar }}">
                                                @error('hasil_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="keterangan_seminar">keterangan</label>
                                                <input type="text" class="form-control" id="keterangan_seminar"
                                                    name="keterangan_seminar"
                                                    value="{{ $wakaKesiswaan->keterangan_seminar }}">
                                                @error('keterangan_seminar')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step7">
                                <div class="card-body">
                                    <h3 class="card-title">Piket Gromming</h3>
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="form-label">Piket Gromming</label>
                                                <input type="file" name="piket_gromming" class="form-control"
                                                    value="{{ $wakaKesiswaan->piket_gromming }}">
                                                @error('piket_gromming')
                                                    <div class="text-danger mt-2"> {{ $message }} </div>
                                                @enderror
                                                @if ($wakaKesiswaan->piket_gromming)
                                                    <p>{{ basename($wakaKesiswaan->piket_gromming) }}</p>
                                                @endif
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
            const steps = ['step1', 'step2', 'step3', 'step4', 'step5', 'step6', 'step7'];
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
