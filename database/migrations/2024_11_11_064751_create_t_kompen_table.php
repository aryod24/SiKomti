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
        Schema::create('t_kompen', function (Blueprint $table) {
            $table->char('UUID_Kompen', 36)->notNullable();
            $table->string('nama_kompen', 100)->notNullable();
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('jenis_tugas')->nullable();
            $table->integer('quota')->nullable();
            $table->integer('jam_kompen')->nullable();
            $table->boolean('status_dibuka')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_akhir')->nullable();
            $table->boolean('Is_Selesai')->nullable();
            $table->unsignedBigInteger('id_kompetensi')->nullable();
            $table->string('periode_kompen', 50)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->string('nama')->nullable(); // Adding the nama field
            $table->timestamps();

            $table->primary('UUID_Kompen');
            $table->foreign('jenis_tugas')->references('id_tugas')->on('m_jenis_tugas')->onDelete('set null');
            $table->foreign('id_kompetensi')->references('id_kompetensi')->on('m_bidang_kompetensi')->onDelete('set null');
            $table->foreign('user_id')->references('user_id')->on('m_user');
            $table->foreign('level_id')->references('level_id')->on('m_user')->onDelete('set null');

            // Adding index for jam_kompen
            $table->index('jam_kompen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_kompen');
    }
};
