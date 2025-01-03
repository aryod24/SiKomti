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
        Schema::create('m_mahasiswa_alpha', function (Blueprint $table) {
            $table->id('id_alpha');
            $table->string('ni', 18)->nullable();
            $table->string('nama', 100)->nullable();
            $table->integer('jam_alpha')->nullable();
            $table->integer('semester'); // Changed semester field to integer
            $table->integer('jam_kompen')->nullable(); // Added jam_kompen field
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_mahasiswa_alpha');
    }
};
