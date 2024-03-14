<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('house')->default('');
            $table->string('street')->default('')->nullable();
            $table->string('suburb')->default('')->nullable();
            $table->integer('postcode')->default('');
            $table->string('state')->default('');
            $table->string('geocode')->default('');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
