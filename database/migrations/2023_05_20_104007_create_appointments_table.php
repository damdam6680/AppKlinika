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
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id')->unique();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedInteger('dentist_id')->unique();
            $table->foreign('dentist_id')->references('id')->on('dentists');
            $table->date('visit_date');
            $table->time('visit_time');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
