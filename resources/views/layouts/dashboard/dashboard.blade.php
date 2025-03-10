@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <h4 class="card-title">Total User</h4>
                            <h6 class="card-subtitle">{{$totalCount}}</h6>
                        </div>
                        <div class="ms-auto">
                            <div class="dropdown">
                                <a href="#" class="link" id="new" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i data-feather="more-horizontal" class="feather-sm"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="new">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-container">
                    <div id="stackedChart"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="row pb-3 border-bottom">
                                <div class="col-3">
                                    <div class="bg-light-primary text-primary text-center py-2 rounded-1">
                                        <i class="ti ti-user fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">Admin</h5>
                                        <p class="text-muted mb-0">Jumlah Admin: {{ $adminCount }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-3 border-bottom">
                                <div class="col-3">
                                    <div class="bg-light-danger text-danger text-center py-2 rounded-1">
                                        <i class="ti ti-user fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">Apoteker</h5>
                                        <p class="text-muted mb-0">Jumlah Apoteker: {{ $apotekerCount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="row pb-3 border-bottom">
                                <div class="col-3">
                                    <div class="bg-light-success text-success text-center py-2 rounded-1">
                                        <i class="ti ti-user fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">Dokter</h5>
                                        <p class="text-muted mb-0">Jumlah Dokter: {{ $dokterCount }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-3">
                                    <div class="bg-light-warning text-warning text-center py-2 rounded-1">
                                        <i class="ti ti-user fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">Perawat</h5>
                                        <p class="text-muted mb-0">Jumlah Perawat: {{ $perawatCount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <h4 class="card-title">Total User</h4>
                            <h6 class="card-subtitle">{{ $totalCount }}</h6>
                        </div>
                        <div class="ms-auto">
                            <div class="dropdown">
                                <a href="#" class="link" id="new" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i data-feather="more-horizontal" class="feather-sm"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="new">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-container">
                    <div id="pieChart"></div> <!-- Ganti ID dari stackedChart ke pieChart -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="row pb-3 border-bottom">
                                <div class="col-3">
                                    <div class="bg-light-primary text-primary text-center py-2 rounded-1">
                                        <i class="ti ti-user fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">Admin</h5>
                                        <p class="text-muted mb-0">Jumlah Admin: {{ $adminCount }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-3 border-bottom">
                                <div class="col-3">
                                    <div class="bg-light-danger text-danger text-center py-2 rounded-1">
                                        <i class="ti ti-user fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">Apoteker</h5>
                                        <p class="text-muted mb-0">Jumlah Apoteker: {{ $apotekerCount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="row pb-3 border-bottom">
                                <div class="col-3">
                                    <div class="bg-light-success text-success text-center py-2 rounded-1">
                                        <i class="ti ti-user fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">Dokter</h5>
                                        <p class="text-muted mb-0">Jumlah Dokter: {{ $dokterCount }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-3">
                                    <div class="bg-light-warning text-warning text-center py-2 rounded-1">
                                        <i class="ti ti-user fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div>
                                        <h5 class="card-title mb-1">Perawat</h5>
                                        <p class="text-muted mb-0">Jumlah Perawat: {{ $perawatCount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sertakan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Sertakan ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(function() {
            "use strict";

            // Ambil data dari controller
            var dataAdmin = @json($adminCount); // Data admin
            var dataApoteker = @json($apotekerCount); // Data apoteker
            var dataDokter = @json($dokterCount); // Data dokter
            var dataPerawat = @json($perawatCount); // Data perawat

            // Konfigurasi chart
            var options = {
                series: [{
                    name: "Admin",
                    data: [dataAdmin],
                }, {
                    name: "Apoteker",
                    data: [dataApoteker],
                }, {
                    name: "Dokter",
                    data: [dataDokter],
                }, {
                    name: "Perawat",
                    data: [dataPerawat],
                }],
                chart: {
                    type: "bar",
                    height: 350,
                    stacked: true,
                    fontFamily: '"Nunito Sans",sans-serif',
                    toolbar: {
                        show: false,
                    },
                },
                colors: ["#3699ff", "#ff6384", "#4bc0c0", "#ffcd56"],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                    width: 2,
                },
                fill: {
                    type: "solid",
                    opacity: 0.2,
                },
                grid: {
                    show: false,
                },
                xaxis: {
                    categories: ["Jumlah"],
                },
                yaxis: {
                    show: false,
                },
                tooltip: {
                    theme: "dark",
                },
                legend: {
                    position: "top",
                    horizontalAlign: "left",
                },
            };

            // Render chart
            var chart = new ApexCharts(document.querySelector("#stackedChart"), options);
            chart.render();
        });
    </script>
    <script>
        $(function() {
            "use strict";

            // Ambil data dari controller
            var dataAdmin = @json($adminCount); // Data admin
            var dataApoteker = @json($apotekerCount); // Data apoteker
            var dataDokter = @json($dokterCount); // Data dokter
            var dataPerawat = @json($perawatCount); // Data perawat

            // Konfigurasi pie chart
            var options = {
                series: [dataAdmin, dataApoteker, dataDokter, dataPerawat], // Data untuk pie chart
                chart: {
                    type: "pie", // Tipe chart adalah pie
                    height: 350,
                    fontFamily: '"Nunito Sans",sans-serif',
                    toolbar: {
                        show: false,
                    },
                },
                labels: ["Admin", "Apoteker", "Dokter", "Perawat"], // Label untuk setiap bagian pie
                colors: ["#3699ff", "#ff6384", "#4bc0c0", "#ffcd56"], // Warna untuk setiap bagian pie
                dataLabels: {
                    enabled: true, // Tampilkan persentase di dalam pie chart
                    style: {
                        fontSize: "14px",
                        fontFamily: '"Nunito Sans",sans-serif',
                    },
                },
                legend: {
                    position: "bottom", // Posisi legend di bawah chart
                    horizontalAlign: "center",
                },
                tooltip: {
                    enabled: true,
                    theme: "dark",
                },
            };

            // Render chart
            var chart = new ApexCharts(document.querySelector("#pieChart"), options);
            chart.render();
        });
    </script>
@endsection
