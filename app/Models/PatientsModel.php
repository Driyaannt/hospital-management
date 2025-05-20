<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientsModel extends Model
{
    use HasFactory;

    protected $table = 'm_patients';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'medical_record_number',
        'ktp',
        'sim',
        'paspor',
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'status',
        'religion',
        'nationality',
        'address_ktp',
        'kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'insurance_number',
        'insurance',
        'address_domisili',
        'phone_home',
        'phone_office',
        'mobile_phone',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_address',
        'emergency_contact_phone',
        'entry_type',
        'verificator',
    ];
}
