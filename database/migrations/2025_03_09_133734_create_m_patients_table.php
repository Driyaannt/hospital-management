<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migration untuk membuat tabel m_patients.
     */
    public function up(): void
    {
        Schema::create('m_patients', function (Blueprint $table) {
            $table->id();
            $table->string('medical_record_number')->unique();
            $table->string('ktp')->nullable();
            $table->string('sim')->nullable();
            $table->string('paspor')->nullable();
            $table->string('name');
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('status')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->default('Indonesia');
            $table->text('address_ktp')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten_kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('insurance')->nullable();
            $table->text('address_domisili')->nullable();
            $table->string('phone_home')->nullable();
            $table->string('phone_office')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->text('emergency_contact_address')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('entry_type')->nullable();
            $table->string('verificator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Rollback migration jika perlu.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_patients');
    }
};
