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
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username', 20)->unique();
            $table->string('password');
            $table->string('nama', 100)->nullable();
            $table->string('jurusan', 100)->nullable();
            $table->string('ni', 18)->nullable()->unique();
            $table->unsignedBigInteger('level_id')->index();
            $table->timestamps();

            $table->foreign('level_id')->references('level_id')->on('m_level');

            // Adding avatar column
            $table->string('avatar')->nullable();

            // Adding kelas and semester columns
            $table->string('kelas')->nullable();
            $table->string('semester')->nullable();
        });

        // Menambahkan indeks pada kolom ni
        Schema::table('m_user', function (Blueprint $table) {
            $table->index('ni');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};
