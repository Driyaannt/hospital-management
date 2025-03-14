<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\AssesmenModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;
use App\Models\PatientsModel;
use Illuminate\Support\Facades\Auth;

class RekamMedikController extends Controller
{
    public function index()
    {
        $assesmen = AssesmenModel::with('patient')->get();
        return view('layouts.rekam-medik.rekam-medik', compact('assesmen'));
    }

    public function create($id = null)
    {
        $assesment = null;
        $patient = null;

        // Coba cari asesmen berdasarkan ID
        $assesment_id = AssesmenModel::with('patient')->find($id);

        if ($assesment_id) {
            $assesment = $assesment_id->toArray();
            $patientId = $assesment['patient']['id'] ?? null;

            if ($patientId) {
                $patient = PatientsModel::find($patientId);
            }
        } else {
            $patient = PatientsModel::find($id);
        }

        return view('layouts.rekam-medik.action-rekam-medik', compact('assesment', 'patient'));
    }



    public function store(Request $request, $id = null)
    {
        // Inisialisasi array data
        $data = $request->all();
        $data['patient_id'] = $request->patient_id;

        if ($id) {
            if (!empty($request->main_complaint)) {
                $data['status'] = 'Selesai';
                $data['verifikator'] = Auth::user()->name;
            } else {
                $data['status'] = 'Proses';
            }

            // dd($data['verifikator']);

            $assesment = AssesmenModel::findOrFail($id);
            $assesment->update($data);
        } else {
            AssesmenModel::create($data);
        }


        return redirect()->route('v-history-rm');
    }

    public function printBarcode(Request $request)
    {
        $data = [
            'medical_record_number' => $request->input('medical_record_number'),
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'insurance' => $request->input('insurance'),
            'ktp' => $request->input('ktp'),
        ];

        // Generate QR Code dengan Endroid
        $qrCode = Builder::create()
            ->writer(new PngWriter()) // Bisa juga pakai SvgWriter untuk SVG
            ->data($data['medical_record_number']) // Data QR Code
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(200)
            ->margin(10)
            ->build();

        // Konversi QR Code ke base64 agar bisa digunakan di PDF
        $barcode = base64_encode($qrCode->getString());

        // Konfigurasi PDF
        $pdf = Pdf::loadView('barcode.print-label', compact('data', 'barcode'))
            ->setPaper([0, 0, 300, 290], 'portrait'); // Ukuran dalam poin (pt)

        return $pdf->stream('barcode.pdf');
    }

    public function show($id)
    {
        // Ambil data asesmen berdasarkan ID
        $assesment_show = AssesmenModel::with('patient')->find($id);

        if (!$assesment_show) {
            return response()->json(["error" => "Data tidak ditemukan"], 404);
        }

        return response()->json([
            'medical_record_number' => $assesment_show->patient->medical_record_number,
            'name' => $assesment_show->patient->name,
            'gender' => $assesment_show->patient->gender,
            'date_of_birth' => $assesment_show->patient->date_of_birth,
            'ktp' => $assesment_show->patient->ktp,
            'kelurahan' => $assesment_show->patient->kelurahan,
            'kecamatan' => $assesment_show->patient->kecamatan,
            'kabupaten_kota' => $assesment_show->patient->kabupaten_kota,
            'provinsi' => $assesment_show->patient->provinsi,
            'religion' => $assesment_show->patient->religion,
            'suku' => $assesment_show->suku,
            'kasus_polisi' => $assesment_show->kasus_polisi,
            'status_perkawinan' => $assesment_show->status_perkawinan,
            'insurance' => $assesment_show->patient->insurance,
            'pendidikan' => $assesment_show->pendidikan,
            'pekerjaan' => $assesment_show->pekerjaan,
            'cara_datang' => $assesment_show->cara_datang,
            'komunikasi' => $assesment_show->komunikasi,
            'transportasi' => $assesment_show->transportasi,

            'trauma' => $assesment_show->trauma,
            'verifikator' => $assesment_show->verifikator,
            'tanggal' => $assesment_show->tanggal,
            'breathing' => $assesment_show->breathing,
            'circulation' => $assesment_show->circulation,
            'blood_pressure' => $assesment_show->blood_pressure,
            'heart_rate' => $assesment_show->heart_rate,
            'body_temperature' => $assesment_show->body_temperature,
            'breathing_frequency' => $assesment_show->breathing_frequency,
            'gangguan_perilaku' => $assesment_show->gangguan_perilaku,
            'disability' => $assesment_show->disability,
            'skala_triase' => $assesment_show->skala_triase,
            'jam_keluar_triase' => $assesment_show->jam_keluar_triase,
            'riwayat_penyakit_sekarang' => $assesment_show->riwayat_penyakit_sekarang,
            'riwayat_penyakit_dahulu' => $assesment_show->riwayat_penyakit_dahulu,
            'akral' => $assesment_show->akral,
            'riwayat_pengobatan' => $assesment_show->riwayat_pengobatan,
            'riwayat_alergi' => $assesment_show->riwayat_alergi,
            'gcs_e' => $assesment_show->gcs_e,
            'pupil' => $assesment_show->pupil,
            'pernafasan' => $assesment_show->pernafasan,
            'refleks_cahaya' => $assesment_show->refleks_cahaya,
            'spo2' => $assesment_show->spo2,
            'main_complaint' => $assesment_show->main_complaint,
            'status' => $assesment_show->status,

        ]);
    }


    public function edit($id)
    {
        $assesment = AssesmenModel::findOrFail($id);
        return view('layouts.rekam-medik.action-rekam-medik', compact('assesment'));
    }

    // public function update(Request $request, $id)
    // {
    //     $data = $request->all();

    //     // Jika keluhan utama tidak kosong, ubah status menjadi "Selesai"
    //     if (!empty($request->keluhan_utama)) {
    //         $data['status'] = 'Selesai';
    //     } else {
    //         $data['status'] = 'Proses';
    //     }
    //     $assesment = AssesmenModel::findOrFail($id);
    //     $assesment->update($request->all());

    //     return redirect()->route('v-history-rm')->with('success', 'Assesment berhasil diperbarui.');
    // }



    public function destroy($id)
    {
        $assesment = AssesmenModel::findOrFail($id);
        $assesment->delete();

        return redirect()->route('v-history-rm');
    }
}
