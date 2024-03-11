<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_name_id')->nullable();
            $table->foreign('test_name_id')->references('id')->on('test_names')->onDelete('cascade');
            $table->text('description');
            $table->unsignedBigInteger('referring_doctor_id')->nullable();
            $table->foreign('referring_doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('referring_doctor_clinic_id')->nullable();
            $table->foreign('referring_doctor_clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
