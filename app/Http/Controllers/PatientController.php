<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientsModel;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patients = PatientsModel::all();
        return view('layouts.master-data.create-patients.patients', compact('patients'));
    }

    // Menampilkan form create atau edit pasien
    public function create($id = null)
    {
        $patient = null;
        $nextMedicalRecordNumber = null;

        if ($id) {
            $patient = PatientsModel::findOrFail($id);
        } else {
            // Generate nomor rekam medis baru
            $lastPatient = PatientsModel::orderBy('medical_record_number', 'desc')->first();

            if ($lastPatient) {
                // Pisahkan berdasarkan tanda "-"
                $parts = explode('-', $lastPatient->medical_record_number);

                // Pastikan array memiliki 3 elemen
                if (count($parts) === 3) {
                    $parts[2] = str_pad((int)$parts[2] + 1, 2, '0', STR_PAD_LEFT);
                    $nextMedicalRecordNumber = implode('-', $parts);
                } else {
                    // Jika format tid_patientak sesuai, gunakan default
                    $nextMedicalRecordNumber = '00-00-01';
                }
            } else {
                // Jika belum ada pasien, mulai dari angka awal
                $nextMedicalRecordNumber = '00-00-01';
            }
        }

        return view('layouts.master-data.create-patients.action-patients', compact('patient', 'nextMedicalRecordNumber'));
    }


    private function getWilayahName($type, $id)
    {
        $url = "";

        switch ($type) {
            case 'provinsi':
                $url = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";
                break;
            case 'kabupaten_kota':
                $url = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" . substr($id, 0, 2) . ".json";
                break;
            case 'kecamatan':
                $url = "https://www.emsifa.com/api-wilayah-indonesia/api/districts/" . substr($id, 0, 4) . ".json";
                break;
        }

        try {
            // Ambil data dari API
            $response = file_get_contents($url);

            // Jika gagal mengambil data, kembalikan null
            if (!$response) {
                error_log("Gagal mengambil data dari API: $url");
                return null;
            }

            $data = json_decode($response, true);

            // Debugging jika data kosong
            if (empty($data)) {
                error_log("Data kosong untuk URL: $url dengan ID: $id");
                return null;
            }

            // Cari ID yang cocok
            foreach ($data as $item) {
                if ($item['id'] == $id) {
                    return $item['name'];
                }
            }

            // Jika tidak ditemukan
            error_log("ID $id tidak ditemukan di API: $url");
        } catch (\Exception $e) {
            error_log("Exception saat mengambil data wilayah: " . $e->getMessage());
            return null; // Jika gagal mengambil data, kembalikan null
        }

        return null;
    }




    // Menyimpan atau memperbarui data pasien
    public function store(Request $request, $id = null)
    {
        $request->validate([
            'medical_record_number' => 'required',
            'ktp' => 'required',
            'name' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'status' => 'required',
            'religion' => 'required',
            'nationality' => 'required',
            'address_ktp' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
            'insurance' => 'required',
            'mobile_phone' => 'required',
            'emergency_contact_name' => 'required',
            'emergency_contact_relationship' => 'required',
            'emergency_contact_address' => 'required',
            'emergency_contact_phone' => 'required',
            'entry_type' => 'required',
        ]);


        // Ambil nama wilayah berdasarkan ID
        $namaProvinsi = $this->getWilayahName('provinsi', $request->provinsi);
        $namaKabupaten = $this->getWilayahName('kabupaten_kota', $request->kabupaten_kota);
        $namaKecamatan = $this->getWilayahName('kecamatan', $request->kecamatan);


        // Buat array data baru untuk disimpan
        $data = $request->all();
        $data['provinsi'] = $namaProvinsi;
        $data['kabupaten_kota'] = $namaKabupaten;
        $data['kecamatan'] = $namaKecamatan;
        $data['kelurahan'] =  $request->kelurahan_name;
        // $data['nationality'] = $request->nationality_name;

        // Debugging: Cek apakah data sudah benar
        // dd($data);

        // Simpan ke database (update jika ID ada, buat baru jika tidak ada)
        if ($id) {
            $patient = PatientsModel::findOrFail($id);
            $patient->update($data);
            $message = 'Pasien berhasil diperbarui.';
        } else {
            $patient = new PatientsModel();
            $patient->fill($data);
            $patient->verificator = Auth::user()->name;
            $patient->save();
            $message = 'Pasien berhasil ditambahkan.';
        }

        return redirect()->route('v-data-patients')->with('success', $message);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'medical_record_number' => 'required',
            'ktp' => 'required',
            'name' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'status' => 'required',
            'religion' => 'required',
            'nationality' => 'required',
            'address_ktp' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
            'insurance' => 'required',
            'mobile_phone' => 'required',
            'emergency_contact_name' => 'required',
            'emergency_contact_relationship' => 'required',
            'emergency_contact_address' => 'required',
            'emergency_contact_phone' => 'required',
            'entry_type' => 'required',
        ]);

        // Cari pasien berdasarkan ID
        $patient = PatientsModel::findOrFail($id);

        // Update data
        $data = $request->all();

        // Simpan perubahan ke database
        $patient->update($data);

        return redirect()->route('v-data-patients')->with('success', 'Pasien berhasil diperbarui.');
    }


    // Menghapus pasien
    public function destroy($id)
    {
        $patient = PatientsModel::findOrFail($id);
        $patient->delete();

        return redirect()->route('v-data-patients')->with('success', 'Pasien berhasil dihapus.');
    }


    public function searchPatient(Request $request)
    {
        $keyword = $request->query('q');

        $patients = PatientsModel::where('ktp', 'LIKE', "%$keyword%")
            ->orWhere('name', 'LIKE', "%$keyword%")
            ->get();

        return response()->json($patients);
    }
}
