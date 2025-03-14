<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Barcode Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            width: 100%;
            height: 90%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border: 2px solid #000; /* Batas luar */
            box-sizing: border-box;
        }

        .info {
            flex: 1;
            text-align: left;
            padding-right: 10px;
        }

        h2 {
            text-transform: uppercase;
            margin-bottom: 10px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 4px 8px;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        .barcode-container {
            flex: 0 0 120px; /* Ukuran tetap */
            text-align: center;
        }

        .barcode-container img {
            width: 80px;
            height: 80px;
        }

        /* Styling untuk cetak (print) */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
                height: 100%;
                border: none;
                display: flex;
                flex-wrap: nowrap;
                justify-content: space-between;
            }

            .barcode-container img {
                width: 100px; /* Ukuran lebih kecil untuk cetak */
                height: auto;
            }

            @page {
                size: 85mm 55mm; /* Ukuran kartu nama (85x55 mm) */
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Informasi Pasien -->
        <div class="info">
            <h2>Informasi Pasien</h2>
            <table>
                <tr>
                    <td><strong>No. Rekam Medis:</strong></td>
                    <td>{{ $data['medical_record_number'] }}</td>
                </tr>
                <tr>
                    <td><strong>Nik:</strong></td>
                    <td>{{ $data['ktp'] }}</td>
                </tr>
                <tr>
                    <td><strong>Nama:</strong></td>
                    <td>{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal:</strong></td>
                    <td>{{ $data['date'] }}</td>
                </tr>
                <tr>
                    <td><strong>Penjamin:</strong></td>
                    <td>{{ $data['insurance'] }}</td>
                </tr>
            </table>
        </div>

        <!-- Barcode -->
        <div class="barcode-container">
            <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode Pasien">
        </div>
    </div>
</body>
</html>
