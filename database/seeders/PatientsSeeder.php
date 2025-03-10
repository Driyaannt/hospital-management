<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientsSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        DB::table('m_patients')->insert([
            [
                'medical_record_number' => 'RM001',
                'ktp' => '1234567890123456',
                'sim' => 'B1234567',
                'paspor' => 'A1234567',
                'name' => 'Budi Santoso',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1990-05-15',
                'gender' => 'Laki-laki',
                'status' => 'Menikah',
                'religion' => 'Islam',
                'nationality' => 'Indonesia',
                'address_ktp' => 'Jl. Merdeka No. 123, Jakarta',
                'kelurahan' => 'Gambir',
                'kecamatan' => 'Gambir',
                'kabupaten_kota' => 'Jakarta Pusat',
                'insurance' => 'BPJS',
                'address_domisili' => 'Jl. Merdeka No. 123, Jakarta',
                'phone_home' => '021123456',
                'phone_office' => '021654321',
                'mobile_phone' => '08123456789',
                'emergency_contact_name' => 'Siti Aminah',
                'emergency_contact_relationship' => 'Istri',
                'emergency_contact_address' => 'Jl. Merdeka No. 123, Jakarta',
                'emergency_contact_phone' => '08129876543',
                'entry_type' => 'Rujukan',
                'verificator' => 'Admin RS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medical_record_number' => 'RM002',
                'ktp' => '9876543210987654',
                'sim' => 'C7654321',
                'paspor' => 'B7654321',
                'name' => 'Ani Wijaya',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1985-08-22',
                'gender' => 'Perempuan',
                'status' => 'Belum Menikah',
                'religion' => 'Kristen',
                'nationality' => 'Indonesia',
                'address_ktp' => 'Jl. Asia Afrika No. 45, Bandung',
                'kelurahan' => 'Braga',
                'kecamatan' => 'Sumur Bandung',
                'kabupaten_kota' => 'Bandung',
                'insurance' => 'Pribadi',
                'address_domisili' => 'Jl. Asia Afrika No. 45, Bandung',
                'phone_home' => '022123456',
                'phone_office' => '022654321',
                'mobile_phone' => '08223456789',
                'emergency_contact_name' => 'Bambang Wijaya',
                'emergency_contact_relationship' => 'Ayah',
                'emergency_contact_address' => 'Jl. Asia Afrika No. 45, Bandung',
                'emergency_contact_phone' => '08229876543',
                'entry_type' => 'IGD',
                'verificator' => 'Admin RS',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
