@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5>{{ isset($assesment) ? 'Edit Rekam Medis' : 'Tambah Rekam Medis' }}</h5>
                    <hr>
                    <form class="form" method="POST"
                        action="{{ isset($assesment['id']) ? route('assesment.update', $assesment['id']) : route('assesment.store') }}">
                        @csrf
                        @if (isset($assesment['id']))
                            @method('PUT') <!-- Wajib gunakan PUT untuk update -->
                        @endif

                        {{-- {{ $assesment->patient->name }} --}}

                        <h4>I. DATA IDENTITAS SOSIAL PASIEN</h4>
                        <!-- Data Pasien (Auto-filled) -->
                        @php
                            $isDoctor = Auth::user()->role == 'dokter'; // Cek apakah role user adalah dokter
                        @endphp

                        @if ($patient)
                            <input type="hidden" name="patient_id" value="{{ $patient['id'] }}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="col-form-label">No RM</label>
                                    <input class="form-control" type="text"
                                        value="{{ $patient['medical_record_number'] ?? '' }}" disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="col-form-label">Nama Pasien</label>
                                    <input class="form-control" type="text" value="{{ $patient['name'] ?? '' }}"
                                        disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="col-form-label">Sex</label>
                                    <input class="form-control" type="text" value="{{ $patient['gender'] ?? '' }}"
                                        disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="date_of_birth" class="col-form-label">Tanggal Lahir</label>
                                    <input class="form-control" type="date" value="{{ $patient['date_of_birth'] ?? '' }}"
                                        disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="ktp" class="col-form-label">No. KTP</label>
                                    <input class="form-control" type="text" value="{{ $patient['ktp'] ?? '' }}"
                                        disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="ktp" class="col-form-label">Kelurahan</label>
                                    <input class="form-control" type="text" value="{{ $patient['kelurahan'] ?? '' }}"
                                        disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="ktp" class="col-form-label">Kecamatan</label>
                                    <input class="form-control" type="text" value="{{ $patient['kecamatan'] ?? '' }}"
                                        disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="ktp" class="col-form-label">Kabupaten/Kota</label>
                                    <input class="form-control" type="text"
                                        value="{{ $patient['kabupaten_kota'] ?? '' }}" disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="ktp" class="col-form-label">Agama</label>
                                    <input class="form-control" type="text" value="{{ $patient['religion'] ?? '' }}"
                                        disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="suku" class="col-form-label">Suku</label>
                                    <input class="form-control" type="text" name="suku" id="suku"
                                        value="{{ old('suku', $assesment['suku'] ?? '') }}"
                                        {{ $isDoctor ? 'disabled' : '' }} />
                                </div>
                                <div class="col-md-6">
                                    <label for="kasus_polisi" class="col-form-label">Kasus Polisi</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kasus_polisi" value="Ya"
                                            id="kasus_polisi_ya" {{ $isDoctor ? 'disabled' : '' }}
                                            {{ old('kasus_polisi', $assesment['kasus_polisi'] ?? '') == 'Ya' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="kasus_polisi_ya">Ya</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kasus_polisi" value="Tidak"
                                            id="kasus_polisi_tidak" {{ $isDoctor ? 'disabled' : '' }}
                                            {{ old('kasus_polisi', $assesment['kasus_polisi'] ?? '') == 'Tidak' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="kasus_polisi_tidak">Tidak</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="status_perkawinan" class="col-form-label">Status Perkawinan</label>
                                    <input class="form-control" type="text" value="{{ $patient['status'] ?? '' }}"
                                        disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="insurance" class="col-form-label">Jenis Pembayaran</label>
                                    <input class="form-control" type="text" value="{{ $patient['insurance'] ?? '' }}"
                                        disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="pendidikan" class="col-form-label">Pendidikan</label>
                                    <select class="form-control" name="pendidikan" id="pendidikan"
                                        {{ $isDoctor ? 'disabled' : '' }}>
                                        <option value="SD"
                                            {{ old('pendidikan', $assesment['pendidikan'] ?? '') == 'SD' ? 'selected' : '' }}>
                                            SD</option>
                                        <option value="SMP"
                                            {{ old('pendidikan', $assesment['pendidikan'] ?? '') == 'SMP' ? 'selected' : '' }}>
                                            SMP</option>
                                        <option value="SMA"
                                            {{ old('pendidikan', $assesment['pendidikan'] ?? '') == 'SMA' ? 'selected' : '' }}>
                                            SMA</option>
                                        <option value="D3"
                                            {{ old('pendidikan', $assesment['pendidikan'] ?? '') == 'D3' ? 'selected' : '' }}>
                                            D3</option>
                                        <option value="S1"
                                            {{ old('pendidikan', $assesment['pendidikan'] ?? '') == 'S1' ? 'selected' : '' }}>
                                            S1</option>
                                        <option value="S2"
                                            {{ old('pendidikan', $assesment['pendidikan'] ?? '') == 'S2' ? 'selected' : '' }}>
                                            S2</option>
                                        <option value="S3"
                                            {{ old('pendidikan', $assesment['pendidikan'] ?? '') == 'S3' ? 'selected' : '' }}>
                                            S3</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="pekerjaan" class="col-form-label">Pekerjaan</label>
                                    <input class="form-control" type="text" name="pekerjaan" id="pekerjaan"
                                        value="{{ old('pekerjaan', $assesment['pekerjaan'] ?? '') }}"
                                        {{ $isDoctor ? 'disabled' : '' }} />
                                </div>
                                <div class="col-md-6">
                                    <label for="cara_datang" class="col-form-label">Cara Datang</label>
                                    <input class="form-control" type="text" name="cara_datang" id="cara_datang"
                                        value="{{ old('cara_datang', $assesment['cara_datang'] ?? '') }}"
                                        {{ $isDoctor ? 'disabled' : '' }} />
                                </div>
                                <div class="col-md-6">
                                    <label for="transportasi" class="col-form-label">Transportasi</label>
                                    <input class="form-control" type="text" name="transportasi" id="transportasi"
                                        value="{{ old('transportasi', $assesment['transportasi'] ?? '') }}"
                                        {{ $isDoctor ? 'disabled' : '' }} />
                                </div>
                                <div class="col-md-6">
                                    <label for="komunikasi" class="col-form-label">Komunikasi</label>
                                    <input class="form-control" type="text" name="komunikasi" id="komunikasi"
                                        value="{{ old('komunikasi', $assesment['komunikasi'] ?? '') }}"
                                        {{ $isDoctor ? 'disabled' : '' }} />
                                </div>
                            </div>
                        @endif

                        @if (Auth::user()->role == 'dokter')
                            <h5 class="mt-3">II. ASSESMEN AWAL MEDIS</h5>
                            <hr>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="main_complaint" class="col-form-label">Nama Dokter</label>
                                    @if (Auth::user()->role == 'dokter')
                                        <input class="form-control" type="text" name="verifikator" value="{{ Auth::user()->name }}"
                                            disabled />
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal" class="col-form-label">Tanggal & Jam</label>
                                    <input class="form-control" type="datetime-local" name="tanggal"
                                        value="{{ old('tanggal', isset($assesment['tanggal']) ? date('Y-m-d\TH:i', strtotime($assesment['tanggal'])) : date('Y-m-d\TH:i')) }}" />
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="trauma" class="col-form-label">Trauma</label>
                                    <select class="form-control" name="trauma" id="trauma">
                                        <option value="" disabled selected>Pilih Kondisi</option>
                                        <option value="Trauma"
                                            {{ old('trauma', $assesment['trauma'] ?? '') == 'Trauma' ? 'selected' : '' }}>
                                            Trauma
                                        </option>
                                        <option value="Non Trauma"
                                            {{ old('trauma', $assesment['trauma'] ?? '') == 'Non Trauma' ? 'selected' : '' }}>
                                            Non Trauma
                                        </option>
                                        <option value="Maternity"
                                            {{ old('trauma', $assesment['trauma'] ?? '') == 'Maternity' ? 'selected' : '' }}>
                                            Maternity
                                        </option>
                                    </select>
                                </div>

                                {{-- <div class="col-md-6">
                                    <label for="airway" class="col-form-label">Airway</label>
                                    <select class="form-control" name="airway" id="airway">
                                        <option value="" disabled selected>Pilih Kondisi</option>
                                        <option value="Paten"
                                            {{ old('airway', $assesment['airway'] ?? '') == 'Paten' ? 'selected' : '' }}>
                                            Paten
                                        </option>
                                        <option value="Tersumbat Parsial"
                                            {{ old('airway', $assesment['airway'] ?? '') == 'Tersumbat Parsial' ? 'selected' : '' }}>
                                            Tersumbat Parsial
                                        </option>
                                        <option value="Tersumbat Total"
                                            {{ old('airway', $assesment['airway'] ?? '') == 'Tersumbat Total' ? 'selected' : '' }}>
                                            Tersumbat Total
                                        </option>
                                    </select>
                                </div> --}}
                            </div>

                            <hr>
                            <h4>Airway</h4>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="breathing" class="col-form-label">Breathing</label>
                                    <input type="text" class="form-control" name="breathing" id="breathing"
                                        value="{{ old('breathing', $assesment['breathing'] ?? '') }}"
                                        placeholder="Masukkan kondisi pernapasan">
                                </div>

                                <div class="col-md-6">
                                    <label for="circulation" class="col-form-label">Circulation</label>
                                    <input type="number" class="form-control" name="circulation" id="circulation"
                                        value="{{ old('circulation', $assesment['circulation'] ?? '') }}"
                                        placeholder="Masukkan kondisi sirkulasi">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <!-- Input untuk Tekanan Darah (TD) -->
                                <div class="col-md-6">
                                    <label for="td" class="col-form-label">Tekanan Darah (TD)</label>
                                    <input type="text" class="form-control" name="blood_pressure" id="td"
                                        value="{{ old('td', $assesment['blood_pressure'] ?? '') }}"
                                        placeholder="Masukkan tekanan darah (mmHg)">
                                </div>

                                <!-- Input untuk Nadi (N) -->
                                <div class="col-md-6">
                                    <label for="nadi" class="col-form-label">Nadi (N)</label>
                                    <input type="number" class="form-control" name="heart_rate" id="nadi"
                                        value="{{ old('nadi', $assesment['heart_rate'] ?? '') }}"
                                        placeholder="Masukkan jumlah denyut per menit">
                                </div>

                                <!-- Input untuk Suhu Tubuh (T) -->
                                <div class="col-md-6">
                                    <label for="temperature" class="col-form-label">Suhu Tubuh (T)</label>
                                    <input type="number" class="form-control" name="body_temperature" id="temperature"
                                        value="{{ old('temperature', $assesment['body_temperature'] ?? '') }}"
                                        placeholder="Masukkan suhu tubuh (°C)">
                                </div>

                                <!-- Input untuk Frekuensi Napas (RR) -->
                                <div class="col-md-6">
                                    <label for="rr" class="col-form-label">Frekuensi Napas (RR)</label>
                                    <input type="number" class="form-control" name="breathing_frequency" id="rr"
                                        value="{{ old('rr', $assesment['breathing_frequency'] ?? '') }}"
                                        placeholder="Masukkan jumlah napas per menit">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="gangguan_perilaku" class="col-form-label">Gangguan Perilaku</label>
                                    <select class="form-control" name="gangguan_perilaku" id="gangguan_perilaku">
                                        <option value="" disabled selected>Pilih Kondisi Gangguan Perilaku
                                        </option>
                                        <option value="Tidak Terganggu"
                                            {{ old('gangguan_perilaku', $assesment['gangguan_perilaku'] ?? '') == 'Tidak Terganggu' ? 'selected' : '' }}>
                                            Tidak Terganggu</option>
                                        <option value="Ada Gangguan"
                                            {{ old('gangguan_perilaku', $assesment['gangguan_perilaku'] ?? '') == 'Ada Gangguan' ? 'selected' : '' }}>
                                            Ada Gangguan</option>
                                        <option value="Tidak Membahayakan"
                                            {{ old('gangguan_perilaku', $assesment['gangguan_perilaku'] ?? '') == 'Tidak Membahayakan' ? 'selected' : '' }}>
                                            Tidak Membahayakan</option>
                                        <option
                                            value="Membahayakan diri sendiri / orang lain (Jika ya lakukan SPO restrain)"
                                            {{ old('gangguan_perilaku', $assesment['gangguan_perilaku'] ?? '') == 'Membahayakan diri sendiri / orang lain (Jika ya lakukan SPO restrain)' ? 'selected' : '' }}>
                                            Membahayakan diri sendiri / orang lain (Jika ya lakukan SPO restrain)
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="disability" class="col-form-label">Disability</label>
                                    <select class="form-control" name="disability" id="disability">
                                        <option value="" disabled selected>Pilih Tingkat Disability</option>
                                        <option value="Alert"
                                            {{ old('disability', $assesment['disability'] ?? '') == 'Alert' ? 'selected' : '' }}>
                                            Alert</option>
                                        <option value="Verbal"
                                            {{ old('disability', $assesment['disability'] ?? '') == 'Verbal' ? 'selected' : '' }}>
                                            Verbal</option>
                                        <option value="Pain"
                                            {{ old('disability', $assesment['disability'] ?? '') == 'Pain' ? 'selected' : '' }}>
                                            Pain</option>
                                        <option value="Unresponsive"
                                            {{ old('disability', $assesment['disability'] ?? '') == 'Unresponsive' ? 'selected' : '' }}>
                                            Unresponsive</option>
                                    </select>
                                </div>
                            </div>





                            {{-- buatkan select skala triase ats 1, ats 2, ats 3 ats 4 , ats 5 --}}
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="skala_triase" class="col-form-label">Skala Triase</label>
                                    <select class="form-control" name="skala_triase" id="skala_triase">
                                        <option value="" disabled selected>Pilih Skala Triase</option>
                                        <option value="ATS 1"
                                            {{ old('skala_triase', $assesment['skala_triase'] ?? '') == 'ATS 1' ? 'selected' : '' }}>
                                            ATS 1 - Resusitasi</option>
                                        <option value="ATS 2"
                                            {{ old('skala_triase', $assesment['skala_triase'] ?? '') == 'ATS 2' ? 'selected' : '' }}>
                                            ATS 2 - Emergensi</option>
                                        <option value="ATS 3"
                                            {{ old('skala_triase', $assesment['skala_triase'] ?? '') == 'ATS 3' ? 'selected' : '' }}>
                                            ATS 3 - Urgensi</option>
                                        <option value="ATS 4"
                                            {{ old('skala_triase', $assesment['skala_triase'] ?? '') == 'ATS 4' ? 'selected' : '' }}>
                                            ATS 4 - Semi Urgensi</option>
                                        <option value="ATS 5"
                                            {{ old('skala_triase', $assesment['skala_triase'] ?? '') == 'ATS 5' ? 'selected' : '' }}>
                                            ATS 5 - Non Urgensi</option>
                                    </select>
                                </div>

                                {{-- jam keluar triase --}}
                                <div class="col-md-6">
                                    <label for="jam_keluar_triase" class="col-form-label">Jam Keluar Triase</label>
                                    <input type="time" class="form-control" name="jam_keluar_triase"
                                        id="jam_keluar_triase"
                                        value="{{ old('jam_keluar_triase', $assesment['jam_keluar_triase'] ?? '') }}"
                                        placeholder="Masukkan jam keluar triase">
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="riwayat_penyakit_sekarang" class="col-form-label">Riwayat Penyakit Sekarang</label>
                                    <textarea class="form-control" name="riwayat_penyakit_sekarang">{{ old('riwayat_penyakit_sekarang', isset($assesment) ? $assesment['riwayat_penyakit_sekarang'] : '') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="riwayat_penyakit_dahulu" class="col-form-label">Riwayat Penyakit Dulu</label>
                                    <textarea class="form-control" name="riwayat_penyakit_dahulu">{{ old('riwayat_penyakit_dahulu', isset($assesment) ? $assesment['riwayat_penyakit_dahulu'] : '') }}</textarea>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="riwayat_pengobatan" class="col-form-label">Riwayat Pengobatan</label>
                                    <textarea class="form-control" name="riwayat_pengobatan">{{ old('riwayat_pengobatan', isset($assesment) ? $assesment['riwayat_pengobatan'] : '') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="riwayat_alergi" class="col-form-label">Riwayat Alergi</label>
                                    <textarea class="form-control" name="riwayat_alergi">{{ old('riwayat_alergi', isset($assesment) ? $assesment['riwayat_alergi'] : '') }}</textarea>
                                </div>
                            </div>


                            <hr>
                            <h4>Tanda-tanda Vital</h4>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="gcs_e" class="col-form-label">gcs_e</label>
                                    <input type="number" class="form-control" name="gcs_e" id="gcs_e"
                                        value="{{ old('gcs_e', $assesment['gcs_e'] ?? '') }}"
                                        placeholder="Masukkan nilai GCS">
                                </div>
                                <div class="col-md-6">
                                    <label for="pupil" class="col-form-label">Pupil</label>
                                    <input type="text" class="form-control" name="pupil" id="pupil"
                                        value="{{ old('pupil', $assesment['pupil'] ?? '') }}"
                                        placeholder="Masukkan kondisi pupil">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="refleks_cahaya" class="col-form-label">Reflek Cahaya</label>
                                    <input type="text" class="form-control" name="refleks_cahaya" id="refleks_cahaya"
                                        value="{{ old('refleks_cahaya', $assesment['refleks_cahaya'] ?? '') }}"
                                        placeholder="Masukkan kondisi reflek cahaya">
                                </div>
                                <div class="col-md-6">
                                    <label for="pernafasan" class="col-form-label">Pernafasan</label>
                                    <input type="text" class="form-control" name="pernafasan" id="pernafasan"
                                        value="{{ old('pernafasan', $assesment['pernafasan'] ?? '') }}"
                                        placeholder="Masukkan kondisi pernafasan">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="spo2" class="col-form-label">SpO2</label>
                                    <input type="number" class="form-control" name="spo2" id="spo2"
                                        value="{{ old('spo2', $assesment['spo2'] ?? '') }}"
                                        placeholder="Masukkan nilai SpO2">
                                </div>
                            </div>

                            <!-- Data Sosial -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="main_complaint" class="col-form-label">Keluhan Utama</label>
                                    <textarea class="form-control" name="main_complaint">{{ old('main_complaint', isset($assesment) ? $assesment['main_complaint'] : '') }}</textarea>
                                </div>
                            </div>
                        @endif
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary"
                                    type="submit">{{ isset($assesment) ? 'Update' : 'Submit' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
