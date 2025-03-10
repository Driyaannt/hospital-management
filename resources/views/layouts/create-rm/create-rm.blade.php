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
                            <p class="mb-3">
                                Cari data pasien berdasarkan NIK atau Nama.
                            </p>

                            <!-- Form Pencarian -->
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="search_patient"
                                    placeholder="Masukkan NIK atau Nama">
                                <button class="btn btn-primary" id="btn_search">Check</button>
                            </div>

                            <!-- Hasil Pencarian -->
                            <div id="patient_result" class="mt-3"></div>
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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>Buat Rekam Medis</h5>
                    <form class="form">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Nama Pasien</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="text" id="example-text-input" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Tinggi Badan</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="text" id="example-text-input" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Tensi Darah</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="text" id="example-text-input" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Berat Badan</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="text" id="example-text-input" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Keluhan</label>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Anamnesis</label>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
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
                        `<div class="alert alert-warning">Masukkan NIK atau Nama pasien.</div>`;
                    return;
                }

                axios.get('/search-patient?q=' + keyword)
                    .then(response => {
                        let data = response.data;
                        if (data.length === 0) {
                            resultDiv.innerHTML = `
                <div class="alert alert-danger d-flex justify-content-between align-items-center">
                    <span>Pasien tidak ditemukan.</span>
                    <a href="/patient/create" class="btn btn-primary btn-sm">Tambah Pasien</a>
                </div>`;
                        } else {
                            let patientList = '<ul class="list-group">';
                            data.forEach(patient => {
                                patientList += `
                    <li class="list-group-item">
                        <strong>${patient.name}</strong> (${patient.ktp}) <br>
                        <small>${patient.kabupaten_kota}, ${patient.provinsi}</small>
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
@endsection
