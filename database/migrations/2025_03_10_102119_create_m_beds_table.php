<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('m_beds', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('bed_number');
            $table->enum('status', ['Available', 'Occupied'])->default('Available');
            $table->integer('capacity')->default(1);
            $table->timestamps();
            // Tambahkan unique constraint untuk kombinasi category + bed_number
            $table->unique(['category', 'bed_number'], 'unique_bed_per_category');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_beds');
    }
};
