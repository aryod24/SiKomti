<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration untuk tabel m_bidang_kompetensi
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_bidang_kompetensi', function (Blueprint $table) {
            $table->id('id_kompetensi');
            $table->string('nama_kompetensi', 100);
            $table->unsignedBigInteger('id_tugas')->nullable();
            $table->timestamps();

            // Foreign key ke tabel m_jenis_tugas
            $table->foreign('id_tugas')->references('id_tugas')->on('m_jenis_tugas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus foreign key terlebih dahulu
        Schema::table('m_bidang_kompetensi', function (Blueprint $table) {
            $table->dropForeign(['id_tugas']);
        });

        // Menghapus tabel
        Schema::dropIfExists('m_bidang_kompetensi');
    }
};