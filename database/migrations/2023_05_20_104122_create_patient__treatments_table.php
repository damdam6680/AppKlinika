<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient__treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('patient_id')->unique();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedInteger('treatment_id')->unique();
            $table->foreign('treatment_id')->references('id')->on('treatments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient__treatments');
    }
};
