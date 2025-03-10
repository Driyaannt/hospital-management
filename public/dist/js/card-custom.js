
$(function () {
    "use strict";

    // Data untuk masing-masing role
    var dataAdmin = [10, 15, 12, 18, 13, 19, 14, 17]; // Contoh data admin
    var dataApoteker = [5, 6, 2, 8, 3, 9, 4, 7]; // Contoh data apoteker
    var dataDokter = [8, 10, 7, 12, 9, 11, 10, 13]; // Contoh data dokter
    var dataPerawat = [3, 4, 5, 6, 7, 8, 9, 10]; // Contoh data perawat

    // Konfigurasi chart
    var options = {
        series: [
            {
                name: "Admin",
                data: dataAdmin,
            },
            {
                name: "Apoteker",
                data: dataApoteker,
            },
            {
                name: "Dokter",
                data: dataDokter,
            },
            {
                name: "Perawat",
                data: dataPerawat,
            },
        ],
        chart: {
            type: "area",
            height: 350,
            stacked: true, // Chart bertumpuk
            fontFamily: '"Nunito Sans",sans-serif',
            toolbar: {
                show: false,
            },
        },
        colors: ["#3699ff", "#ff6384", "#4bc0c0", "#ffcd56"], // Warna untuk setiap series
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
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"], // Label bulan
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
