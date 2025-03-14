@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">Data Pasien</h5>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('v-patient-create') }}" class="btn btn-primary">Tambah Pasien</a>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No. Rekam Medis</th>
                                    <th>KTP</th>
                                    <th>SIM</th>
                                    <th>Paspor</th>
                                    <th>Nama Pasien</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat (KTP)</th>
                                    <th>Alamat Domisili</th>
                                    <th>No. Telepon</th>
                                    <th>Asuransi</th>
                                    <th>Tempat Lahir</th>
                                    <th>Status</th>
                                    <th>Agama</th>
                                    <th>Kewarganegaraan</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Provinsi</th>
                                    <th>Telepon Rumah</th>
                                    <th>Telepon Kantor</th>
                                    <th>Nama Kontak Darurat</th>
                                    <th>Hubungan Kontak Darurat</th>
                                    <th>Alamat Kontak Darurat</th>
                                    <th>Telepon Kontak Darurat</th>
                                    <th>Tipe Masuk</th>
                                    <th>Verifikator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                <tr>
                                    <td>
                                        <a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-warning btn-sm" onclick="confirmEdit(event)">Edit</a>
                                        <form action="{{ route('patient.delete', $patient->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event)">Delete</button>
                                        </form>
                                    </td>
                                    <td>{{ $patient->medical_record_number }}</td>
                                    <td>{{ $patient->ktp }}</td>
                                    <td>{{ $patient->sim }}</td>
                                    <td>{{ $patient->paspor }}</td>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->gender }}</td>
                                    <td>{{ $patient->date_of_birth }}</td>
                                    <td>{{ $patient->address_ktp }}</td>
                                    <td>{{ $patient->address_domisili }}</td>
                                    <td>{{ $patient->mobile_phone }}</td>
                                    <td>{{ $patient->insurance }}</td>
                                    <td>{{ $patient->verificator }}</td>
                                    <td>{{ $patient->place_of_birth }}</td>
                                    <td>{{ $patient->status }}</td>
                                    <td>{{ $patient->religion }}</td>
                                    <td>{{ $patient->nationality }}</td>
                                    <td>{{ $patient->kelurahan }}</td>
                                    <td>{{ $patient->kecamatan }}</td>
                                    <td>{{ $patient->kabupaten_kota }}</td>
                                    <td>{{ $patient->provinsi }}</td>
                                    <td>{{ $patient->phone_home }}</td>
                                    <td>{{ $patient->phone_office }}</td>
                                    <td>{{ $patient->emergency_contact_name }}</td>
                                    <td>{{ $patient->emergency_contact_relationship }}</td>
                                    <td>{{ $patient->emergency_contact_address }}</td>
                                    <td>{{ $patient->emergency_contact_phone }}</td>
                                    <td>{{ $patient->entry_type }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#zero_config').DataTable();
        });

        function confirmDelete(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus data pasien ini?')) {
                event.target.closest('form').submit();
            }
        }

        function confirmEdit(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin mengedit data pasien ini?')) {
                window.location.href = event.target.href;
            }
        }
    </script>
@endsection
