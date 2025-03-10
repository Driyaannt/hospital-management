@extends('app')

@section('content')
    <!-- Row 1 -->
    <div class="row">
        <div class="col-lg-12">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ isset($patient) ? 'Edit Pasien' : 'Tambah Pasien' }}</h5>
                        <hr>
                        <form class="form" method="POST"
                            action="{{ isset($patient) ? route('patient.update', $patient->id) : route('patient.store') }}">
                            @csrf <!-- Tambahkan CSRF token -->
                            @if (isset($patient))
                                @method('PUT') <!-- Gunakan method PUT untuk update -->
                            @endif

                            <!-- Nomor Rekam Medis (Auto Increment) -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="medical_record_number" class="col-form-label">No. Rekam Medis</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="medical_record_number"
                                            name="medical_record_number"
                                            value="{{ isset($patient) ? $patient->medical_record_number : $nextMedicalRecordNumber }}"
                                            readonly />
                                    </div>
                                </div>
                            </div>

                            <!-- KTP, SIM, Paspor -->
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="ktp" class="col-form-label">No. KTP</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="ktp" name="ktp"
                                            value="{{ isset($patient) ? $patient->ktp : old('ktp') }}" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="sim" class="col-form-label">No. SIM</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="sim" name="sim"
                                            value="{{ isset($patient) ? $patient->sim : old('sim') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="paspor" class="col-form-label">No. Paspor</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="paspor" name="paspor"
                                            value="{{ isset($patient) ? $patient->paspor : old('paspor') }}" />
                                    </div>
                                </div>
                            </div>

                            <!-- Nama Pasien -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="name" class="col-form-label">Nama Pasien</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="name" name="name"
                                            value="{{ isset($patient) ? $patient->name : old('name') }}" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Tempat Tanggal Lahir -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="place_of_birth" class="col-form-label">Tempat Lahir</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="place_of_birth" name="place_of_birth"
                                            value="{{ isset($patient) ? $patient->place_of_birth : old('place_of_birth') }}"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="date_of_birth" class="col-form-label">Tanggal Lahir</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="date" id="date_of_birth" name="date_of_birth"
                                            value="{{ isset($patient) ? $patient->date_of_birth : old('date_of_birth') }}"
                                            required />
                                    </div>
                                </div>
                            </div>

                            <!-- Jenis Kelamin (Radio Button) -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="col-form-label">Jenis Kelamin</label>
                                    <div class="col-md-12">
                                        <div class="d-flex gap-3"> <!-- Menggunakan Flexbox agar sejajar -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="Male"
                                                    {{ isset($patient) && $patient->gender == 'Male' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="male">Laki-laki</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="Female"
                                                    {{ isset($patient) && $patient->gender == 'Female' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="female">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Status (Radio Button) -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="col-form-label">Status</label>
                                    <div class="col-md-12">
                                        <div class="d-flex gap-3 flex-wrap"> <!-- Flexbox untuk sejajar dan responsif -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="single" value="Single"
                                                    {{ isset($patient) && $patient->status == 'Single' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="single">Belum Menikah</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="married" value="Married"
                                                    {{ isset($patient) && $patient->status == 'Married' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="married">Menikah</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="divorced" value="Divorced"
                                                    {{ isset($patient) && $patient->status == 'Divorced' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="divorced">Cerai</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="widowed" value="Widowed"
                                                    {{ isset($patient) && $patient->status == 'Widowed' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="widowed">Duda/Janda</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Agama (Radio Button) -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="col-form-label">Agama</label>
                                    <div class="col-md-12">
                                        <div class="d-flex gap-3 flex-wrap"> <!-- Flexbox untuk sejajar dan responsif -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="religion"
                                                    id="islam" value="Islam"
                                                    {{ isset($patient) && $patient->religion == 'Islam' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="islam">Islam</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="religion"
                                                    id="kristen" value="Kristen"
                                                    {{ isset($patient) && $patient->religion == 'Kristen' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="kristen">Kristen</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="religion"
                                                    id="katholik" value="Katholik"
                                                    {{ isset($patient) && $patient->religion == 'Katholik' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="katholik">Katholik</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="religion"
                                                    id="hindu" value="Hindu"
                                                    {{ isset($patient) && $patient->religion == 'Hindu' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="hindu">Hindu</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="religion"
                                                    id="buddha" value="Buddha"
                                                    {{ isset($patient) && $patient->religion == 'Buddha' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="buddha">Buddha</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="religion"
                                                    id="other" value="Other"
                                                    {{ isset($patient) && $patient->religion == 'Other' ? 'checked' : '' }}
                                                    required />
                                                <label class="form-check-label" for="other">Lainnya</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Kebangsaan (API) -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="nationality" class="col-form-label">Kebangsaan</label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="nationality" name="nationality" required>
                                            <option value="">Pilih Kebangsaan</option>
                                            @if (isset($patient) && $patient->nationality)
                                                <option value="{{ $patient->nationality }}" selected>
                                                    {{ $patient->nationality }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <!-- Alamat Lengkap (KTP) -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="address_ktp" class="col-form-label">Alamat Lengkap (KTP)</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="address_ktp" name="address_ktp" required>{{ isset($patient) ? $patient->address_ktp : old('address_ktp') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Kelurahan, Kecamatan, Kabupaten/Kota (API Indonesia) -->
                            <div class="row mt-3">
                                <!-- Provinsi -->
                                <div class="col-md-4">
                                    <label for="provinsi" class="col-form-label">Provinsi</label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="provinsi" name="provinsi" required>
                                            <option value="">Pilih Provinsi</option>
                                            @if (isset($patient) && $patient->provinsi)
                                                <option value="{{ $patient->provinsi }}" selected>
                                                    {{ $patient->provinsi }}
                                            @endif
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Kabupaten/Kota -->
                                <div class="col-md-4">
                                    <label for="kabupaten_kota" class="col-form-label">Kabupaten/Kota</label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="kabupaten_kota" name="kabupaten_kota" required>
                                            <option value="">Pilih Kabupaten/Kota</option>
                                            @if (isset($patient) && $patient->kabupaten_kota)
                                                <option value="{{ $patient->kabupaten_kota }}" selected>
                                                    {{ $patient->kabupaten_kota }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <!-- Kecamatan -->
                                <div class="col-md-4">
                                    <label for="kecamatan" class="col-form-label">Kecamatan</label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="kecamatan" name="kecamatan" required>
                                            <option value="">Pilih Kecamatan</option>
                                            @if (isset($patient) && $patient->kecamatan)
                                                <option value="{{ $patient->kecamatan }}" selected>
                                                    {{ $patient->kecamatan }}
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <!-- Kelurahan -->
                                <div class="col-md-4 mt-3">
                                    <label for="kelurahan" class="col-form-label">Kelurahan</label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="kelurahan" name="kelurahan" required>
                                            <option value="">Pilih Kelurahan</option>
                                            @if (isset($patient) && $patient->kelurahan)
                                                <input type="hidden" id="kelurahan_name" name="kelurahan_name"
                                                    value="{{ $patient->kelurahan }}">
                                                <option value="{{ $patient->kelurahan }}" selected>
                                                    {{ $patient->kelurahan }}
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <!-- Nama Asuransi (Selection) -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="insurance" class="col-form-label">Nama Asuransi</label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="insurance" name="insurance" required>
                                            <option value="BPJS"
                                                {{ isset($patient) && $patient->insurance == 'BPJS' ? 'selected' : '' }}>
                                                BPJS</option>
                                            <option value="Prudential"
                                                {{ isset($patient) && $patient->insurance == 'Prudential' ? 'selected' : '' }}>
                                                Prudential</option>
                                            <option value="AIA"
                                                {{ isset($patient) && $patient->insurance == 'AIA' ? 'selected' : '' }}>
                                                AIA</option>
                                            <option value="Other"
                                                {{ isset($patient) && $patient->insurance == 'Other' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h7 class="mt-3">
                                Diisi bila alamat tempat tinggal sekarang berbeda dengan yang tercantum di KTP / ID pasien
                            </h7>
                            <hr>

                            <!-- Alamat Domisili (Jika Berbeda dengan KTP) -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="address_domisili" class="col-form-label">Alamat Domisili</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="address_domisili" name="address_domisili">{{ isset($patient) ? $patient->address_domisili : old('address_domisili') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="phone_home" class="col-form-label">Telepon Rumah</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="phone_home" name="phone_home"
                                            value="{{ isset($patient) ? $patient->phone_home : old('phone_home') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="phone_office" class="col-form-label">Telepon Kantor</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="phone_office" name="phone_office"
                                            value="{{ isset($patient) ? $patient->phone_office : old('phone_office') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="mobile_phone" class="col-form-label">Mobile Phone</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="mobile_phone" name="mobile_phone"
                                            value="{{ isset($patient) ? $patient->mobile_phone : old('mobile_phone') }}"
                                            required />
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h7>
                                Orang yang dapat dihubungi Dalam Keaadan Darurat
                            </h7>
                            <hr>


                            <!-- Kontak Darurat -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="emergency_contact_name" class="col-form-label">Nama Kontak Darurat</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="emergency_contact_name"
                                            name="emergency_contact_name"
                                            value="{{ isset($patient) ? $patient->emergency_contact_name : old('emergency_contact_name') }}"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="emergency_contact_relationship" class="col-form-label">Hubungan</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="emergency_contact_relationship"
                                            name="emergency_contact_relationship"
                                            value="{{ isset($patient) ? $patient->emergency_contact_relationship : old('emergency_contact_relationship') }}"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="emergency_contact_address" class="col-form-label">Alamat Lengkap</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="emergency_contact_address" name="emergency_contact_address" required>{{ isset($patient) ? $patient->emergency_contact_address : old('emergency_contact_address') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="emergency_contact_phone" class="col-form-label">Nomor Telepon</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="emergency_contact_phone"
                                            name="emergency_contact_phone"
                                            value="{{ isset($patient) ? $patient->emergency_contact_phone : old('emergency_contact_phone') }}"
                                            required />
                                    </div>
                                </div>
                            </div>

                            <!-- Awal Masuk (Selection) -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="entry_type" class="col-form-label">Awal Masuk</label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="entry_type" name="entry_type" required>
                                            <option value="IGD"
                                                {{ isset($patient) && $patient->entry_type == 'IGD' ? 'selected' : '' }}>
                                                IGD</option>
                                            <option value="IRJ"
                                                {{ isset($patient) && $patient->entry_type == 'IRJ' ? 'selected' : '' }}>
                                                IRJ</option>
                                            <option value="Paviliyun"
                                                {{ isset($patient) && $patient->entry_type == 'Paviliyun' ? 'selected' : '' }}>
                                                Paviliyun</option>
                                            <option value="Other"
                                                {{ isset($patient) && $patient->entry_type == 'Other' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Verifikator (Berdasarkan yang Login) -->
                                <div class="col-md-6">
                                    <label for="verificator" class="col-form-label">Verifikator</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="verificator" name="verificator"
                                            value="{{ Auth::user()->name }}" readonly />
                                    </div>
                                </div>
                            </div>




                            <!-- Tombol Submit -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button class="btn btn-primary"
                                        type="submit">{{ isset($patient) ? 'Update' : 'Submit' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const provinsiSelect = document.getElementById('provinsi');
        const kabupatenSelect = document.getElementById('kabupaten_kota');
        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');

        // Ambil daftar provinsi saat halaman dimuat
        axios.get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => {
                response.data.forEach(province => {
                    const option = document.createElement('option');
                    const nama_province = province.name;
                    option.value = province.id;
                    option.textContent = province.name;
                    provinsiSelect.appendChild(option);
                });
            });


        // Saat provinsi dipilih, ambil daftar kabupaten/kota
        provinsiSelect.addEventListener('change', function() {
            const provinceId = this.value;
            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
            if (provinceId) {
                axios.get(
                        `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                    .then(response => {
                        response.data.forEach(regency => {
                            const option = document.createElement('option');
                            option.value = regency.id;
                            option.textContent = regency.name;
                            kabupatenSelect.appendChild(option);
                        });
                    });
            }
        });

        // Saat kabupaten/kota dipilih, ambil daftar kecamatan
        kabupatenSelect.addEventListener('change', function() {
            const regencyId = this.value;
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

            if (regencyId) {
                axios.get(
                        `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyId}.json`)
                    .then(response => {
                        response.data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.name;
                            kecamatanSelect.appendChild(option);
                        });
                    });
            }
        });

        // Saat kecamatan dipilih, ambil daftar kelurahan
        let kelurahanData = {}; // Objek untuk menyimpan data kelurahan

        // Saat kecamatan dipilih, ambil daftar kelurahan
        kecamatanSelect.addEventListener("change", function() {
            const districtId = this.value;
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
            kelurahanData = {}; // Kosongkan data sebelumnya

            if (districtId) {
                axios
                    .get(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtId}.json`)
                    .then(response => {
                        response.data.forEach(village => {
                            const option = document.createElement("option");
                            option.value = village.id;
                            option.textContent = village.name;
                            kelurahanSelect.appendChild(option);

                            // Simpan data dalam objek untuk digunakan nanti
                            kelurahanData[village.id] = village.name;
                        });
                    });
            }
        });

        // Saat kelurahan dipilih, cari nama dari ID
        kelurahanSelect.addEventListener("change", function() {
            const villageId = this.value;
            const villageName = kelurahanData[villageId] || "";

            console.log("ID Kelurahan:", villageId);
            console.log("Nama Kelurahan:", villageName);

            // Set nilai input hidden agar terkirim ke backend
            document.getElementById("kelurahan_name").value = villageName;
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nationalitySelect = document.getElementById('nationality');

        // Ambil data kebangsaan dari REST Countries API
        axios.get('https://restcountries.com/v3.1/all')
            .then(response => {
                // Urutkan berdasarkan nama negara (opsional)
                const countries = response.data.sort((a, b) => a.name.common.localeCompare(b.name.common));

                // Masukkan data ke dropdown
                countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.name.common; // Kode negara (contoh: ID untuk Indonesia)
                    option.textContent = country.name.common; // Nama negara
                    nationalitySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Gagal mengambil data kebangsaan:', error);
            });
    });
</script>
