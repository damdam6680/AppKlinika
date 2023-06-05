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
        Schema::create('treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('appointments_id')->unique();
            $table->foreign('appointments_id')->references('id')->on('appointments');
            $table->string('treatment_name', 50);
            $table->text('description');
            $table->integer("WaitingTime");
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
