@extends('app')

@section('content')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card w-100 bg-light-info overflow-hidden shadow-none">
                <div class="card-body py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-6">
                            <h5 class="fw-semibold mb-3 fs-5">Welcome back {{ Auth::user()->name }}</h5>
                            @if (Auth::user()->role == 'admin')
                                <p class="mb-3">
                                    Cari data pasien berdasarkan NIK / Nama / No RM/ No Asuransi.
                                </p>

                                <!-- Form Pencarian -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="search_patient"
                                        placeholder="Masukkan NIK atau Nama">
                                    <button class="btn btn-primary" id="btn_search">Check</button>
                                </div>

                                <!-- Hasil Pencarian -->
                                <div id="patient_result" class="mt-3"></div>
                            @endif
                        </div>
                        <div class="col-sm-5">
                            <div class="position-relative mb-n7 text-end">
                                <img src="{{ asset('images/welcome-bg2.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">Data Rekam Medis</h5>
                    </div>
                    {{-- <div class="mb-3">
                        <a href="{{ route('v-assesment-create') }}" class="btn btn-primary">Tambah Rekam Medis</a>
                    </div> --}}
                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Status</th>
                                    <th>Keterangan Terakhir</th>
                                    @if (Auth::user()->role == 'admin')
                                        <th>Label Pasien</th>
                                    @endif
                                    <th>No Rekam Medis</th>
                                    <th>Nama Pasien</th>
                                    <th>Tanggal Rekam Medis</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Penjamin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assesmen as $data)
                                    <tr>
                                        <td>
                                            <a href="{{ route('v-assesment-edit', $data->id) }}" class="btn btn-sm btn-warning"
                                                onclick="confirmEdit(event)">Edit</a>
                                            <form action="{{ route('assesment.delete', $data->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete(event)">Delete</button>
                                            </form>
                                            <a href="#" class="btn btn-sm btn-info show-data"
                                                data-id="{{ $data->id }}">Show</a>
                                        </td>
                                        <td>
                                            @if ($data->status === 'Proses')
                                                <span class="badge bg-warning text-dark">Proses</span>
                                            @elseif ($data->status === 'Selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak Diketahui</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->keterangan_terakhir)
                                                <span class="badge bg-primary">{{ $data->keterangan_terakhir }}</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak Diketahui</span>
                                            @endif
                                        </td>
                                        @if (Auth::user()->role == 'admin')
                                            <td>
                                                <a href="{{ route('print.barcode', [
                                                    'medical_record_number' => $data->patient->medical_record_number,
                                                    'name' => $data->patient->name,
                                                    'date' => $data->tanggal,
                                                    'insurance' => $data->patient->insurance,
                                                    'ktp' => $data->patient->ktp,
                                                ]) }}"
                                                    class="btn btn-primary btn-sm" target="_blank">Print Label</a>

                                            </td>
                                        @endif
                                        <td>{{ $data->patient->medical_record_number }}</td>
                                        <td>{{ $data->patient->name }}</td>
                                        <td>{{ $data->tanggal }}</td>
                                        <td>{{ $data->patient->gender }}</td>
                                        <td>{{ $data->patient->insurance }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="showModal" class="modal fade" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="showModalLabel">Detail Data</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <!-- Data akan dimuat di sini melalui AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("btn_search").addEventListener("click", function() {
                let keyword = document.getElementById("search_patient").value;
                let resultDiv = document.getElementById("patient_result");

                if (!keyword.trim()) {
                    resultDiv.innerHTML =
                        `<div class="alert alert-warning">Masukkan NIK / Nama / No RM / No Asuransi.</div>`;
                    return;
                }

                axios.get('/rekam-medik/search-patient?q=' + keyword)
                    .then(response => {
                        let data = response.data;
                        console.log("Data pasien ditemukan:", data);

                        if (data.length === 0) {
                            resultDiv.innerHTML = `
                        <div class="alert alert-danger d-flex justify-content-between align-items-center">
                            <span>Pasien tidak ditemukan.</span>
                            <a href="/patient/create" class="btn btn-primary btn-sm">Tambah Pasien</a>
                        </div>`;
                        } else {
                            let patientList = '<ul class="list-group">';
                            data.forEach(patient => {
                                if (!patient.id) {
                                    console.error("Pasien tanpa ID:", patient);
                                    return; // Jika ID tidak ada, jangan buat link
                                }

                                let assesmentUrl =
                                    `/rekam-medik/create-assesment/${patient.id}`;

                                patientList += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>${patient.name}</strong> (${patient.ktp}) <br>
                                    <small>${patient.kabupaten_kota}, ${patient.provinsi}</small>
                                </div>
                                <a href="${assesmentUrl}" class="btn btn-success btn-sm">
                                    Tambah Data
                                </a>
                            </li>`;
                            });
                            patientList += '</ul>';
                            resultDiv.innerHTML = patientList;
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching patient data:", error);
                        resultDiv.innerHTML = `
                         <div class="alert alert-danger">Terjadi kesalahan saat mencari data.</div>`;
                    });

            });

        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#zero_config').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.show-data').on('click', function(event) {
                event.preventDefault(); // Mencegah default action dari link
                var dataId = $(this).data('id'); // Ambil ID dari atribut data-id

                // Kirim permintaan AJAX ke route 'v-assesment-show'
                $.ajax({
                    url: "{{ route('v-assesment-show', '') }}/" + dataId,
                    method: 'GET',
                    dataType: 'json', // Pastikan format data JSON
                    success: function(response) {
                        // Periksa apakah respons memiliki data yang diinginkan
                        if (response && response.name && response.ktp && response.gender) {
                            // Format data dalam bentuk tabel
                            var content = `
                        <table class="table table-bordered">
                            <tr>
                                <th>No Rekam Medik</th>
                                <td>${response.medical_record_number}</td>
                            </tr>
                            <tr>
                                    <th>Nama</th>
                                    <td>${response.name}</td>
                                </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>${response.gender}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>${response.date_of_birth}</td>
                            </tr>
                            <tr>
                                <th>KTP</th>
                                <td>${response.ktp}</td>
                            </tr>
                            <tr>
                                <th>Kelurahan</th>
                                <td>${response.kelurahan}</td>
                            </tr>
                            <tr>
                                <th>Kecamatan</th>
                                <td>${response.kecamatan}</td>
                            </tr>
                            <tr>
                                <th>Kabupatan/kota</th>
                                <td>${response.kabupaten_kota}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>${response.religion}</td>
                            </tr>
                            <tr>
                                <th>Suku</th>
                                <td>${response.suku}</td>
                            </tr>
                            <tr>
                                <th>Status Perkawinan</th>
                                <td>${response.status}</td>
                            </tr>
                            <tr>
                                <th>Jenis Pembayaran</th>
                                <td>${response.insurance}</td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <td>${response.pendidikan}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>${response.pekerjaan}</td>
                            </tr>
                            <tr>
                                <th>Cara Datang</th>
                                <td>${response.cara_datang}</td>
                            </tr>
                            <tr>
                                <th>Transportasi</th>
                                <td>${response.transportasi}</td>
                            </tr>
                            <tr>
                                <th>Komunikasi</th>
                                <td>${response.komunikasi}</td>
                            </tr>
                        </table>

                        <hr>
                        <h5 class="fw-semibold mb-3 fs-5">Assesmen Awal Medis</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Tanggal</th>
                                <td>${response.tanggal}</td>
                            </tr>
                            <tr>
                                <th>Trauma</th>
                                <td>${response.trauma}</td>
                            </tr>
                            <tr>
                                <th>Trauma</th>
                                <td>${response.trauma}</td>
                            </tr>
                            <tr>
                                <th>Breathing</th>
                                <td>${response.breathing}</td>
                            </tr>
                            <tr>
                                <th>Circulation</th>
                                <td>${response.circulation}</td>
                            </tr>
                            <tr>
                                <th>Tekanan Darah</th>
                                <td>${response.blood_pressure}</td>
                            </tr>
                            <tr>
                                <th>Nadi</th>
                                <td>${response.heart_rate}</td>
                            </tr>
                            <tr>
                                <th>Suhu Tubuh</th>
                                <td>${response.body_temperature}</td>
                            </tr>
                            <tr>
                                <th>Frekuensi Nafas</th>
                                <td>${response.breathing_frequency}</td>
                            </tr>
                            <tr>
                                <th>Gangguan Perilaku</th>
                                <td>${response.gangguan_perilaku}</td>
                            </tr>
                            <tr>
                                <th>Disability</th>
                                <td>${response.disability}</td>
                            </tr>
                            <tr>
                                <th>Skala Triase</th>
                                <td>${response.skala_triase}</td>
                            </tr>
                            <tr>
                                <th>Jam Keluar Triase</th>
                                <td>${response.jam_keluar_triase}</td>
                            </tr>
                            <tr>
                                <th>Riwayat Penyakit Sekarang</th>
                                <td>${response.riwayat_penyakit_sekarang}</td>
                            </tr>
                            <tr>
                                <th>Riwayat Penyakit Dahuku</th>
                                <td>${response.riwayat_penyakit_dahulu}</td>
                            </tr>
                            <tr>
                                <th>Riwayat Pengobatan</th>
                                <td>${response.riwayat_pengobatan}</td>
                            </tr>
                            <tr>
                                <th>Riwayat Alergi</th>
                                <td>${response.riwayat_alergi}</td>
                            </tr>
                            <tr>
                                <th>GCS</th>
                                <td>${response.gcs_e}</td>
                            </tr>
                            <tr>
                                <th>Reflek Cahaya</th>
                                <td>${response.refleks_cahaya}</td>
                            </tr>
                            <tr>
                                <th>Pernafasan</th>
                                <td>${response.pernafasan}</td>
                            </tr>
                            <tr>
                                <th>SPO2</th>
                                <td>${response.spo2}</td>
                            </tr>
                                <th>Keluhan Utama</th>
                                <td>${response.main_complaint}</td>
                            </tr>
                            <tr>
                                <th>Riwayat Penyakit Keluarga</th>
                                <td>${response.keterangan_terakhir}</td>
                            </tr>
                            <tr>
                                <th>Dokter</th>
                                <td>${response.verifikator}</td>
                            </tr>

                        </table>

                        `;
                            $('#modalBodyContent').html(content);
                        } else {
                            $('#modalBodyContent').html("<p>Data tidak tersedia.</p>");
                        }

                        // Menampilkan modal
                        $('#showModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error("Error: ", xhr
                            .responseText); // Tampilkan error di console
                        $('#modalBodyContent').html(
                            "<p>Terjadi kesalahan saat mengambil data.</p>");
                    }
                });
            });
        });
    </script>
@endsection
