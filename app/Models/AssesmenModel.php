<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmenModel extends Model
{
    protected $table = 'tr_assesmen';

    protected $fillable = [
        'suku', 'pendidikan', 'pekerjaan', 'status_perkawinan',
        'cara_datang', 'komunikasi', 'transportasi', 'patient_id', 'name_dokter', 'tanggal',
        'trauma', 'main_complaint', 'breathing', 'circulation',
        'blood_pressure', 'heart_rate', 'body_temperature', 'breathing_frequency',
        'disability', 'gangguan_perilaku', 'skala_triase', 'jam_keluar_triase', 'pernafasan','akral',
        'riwayat_penyakit_sekarang', 'riwayat_penyakit', 'riwayat_pengobatan',
        'gcs_e', 'refleks_cahaya', 'spo2', 'riwayat_alergi', 'keluhan_utama', 'keterangan_terakhir',
        'status', 'verifikator'
    ];


    /**
     * Relasi ke tabel m_patients
     */
    public function patient()
    {
        return $this->belongsTo(PatientsModel::class, 'patient_id', 'id');
    }
}
