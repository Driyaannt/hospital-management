<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tr_assesmen', function (Blueprint $table) {
            $table->id();
            $table->String('suku')->nullable();
            $table->String('pendidikan')->nullable();
            $table->String('pekerjaan')->nullable();
            $table->String('status_perkawinan')->nullable();
            $table->String('cara_datang')->nullable();
            $table->String('komunikasi')->nullable();
            $table->String('transportasi')->nullable();
            $table->foreignId('patient_id')->constrained('m_patients')->onDelete('cascade');
            $table->string('name_dokter')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->enum('trauma', ['Trauma', 'Non Trauma', 'Maternity'])->nullable();
            $table->string('main_complaint')->nullable();
            // $table->enum('airway', ['Paten', 'Tersumbat Parsial', 'Tersumbat Total'])->nullable();
            $table->string('breathing')->nullable();
            $table->string('circulation')->nullable();
            $table->string('blood_pressure')->nullable(); // Mengganti dari systolic/diastolic ke satu kolom
            $table->integer('heart_rate')->nullable();
            $table->float('body_temperature')->nullable();
            $table->integer('breathing_frequency')->nullable();
            $table->enum('disability', ['Alert', 'Verbal', 'Pain', 'Unresponsive'])->nullable();
            $table->string('skala_nyeri')->nullable();
            $table->enum('gangguan_perilaku', ['Tidak Terganggu', 'Ada Gangguan', 'Tidak Membahayakan', 'Membahayakan diri sendiri / orang lain (Jika ya lakukan SPO restrain)'])->nullable();
            $table->enum('skala_triase', ['ATS 1', 'ATS 2', 'ATS 3', 'ATS 4', 'ATS 5'])->nullable();
            $table->time('jam_keluar_triase')->nullable();
            $table->text('riwayat_penyakit_sekarang')->nullable();
            $table->text('riwayat_penyakit')->nullable();
            $table->text('akral')->nullable();
            $table->text('riwayat_pengobatan')->nullable();
            $table->string('gcs_e')->nullable();
            $table->string('pernafasan')->nullable();
            $table->string('refleks_cahaya')->nullable();
            $table->integer('spo2')->nullable();
            $table->String('riwayat_alergi')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->text('keterangan_terakhir')->nullable();
            $table->enum('status', ['Proses', 'Selesai'])->default('Proses');
            $table->string('verifikator')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tr_assesmen');
    }
};
