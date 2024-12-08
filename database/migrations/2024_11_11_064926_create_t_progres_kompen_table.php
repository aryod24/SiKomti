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
        Schema::create('t_progres_kompen', function (Blueprint $table) {
            $table->id('id_progres')->autoIncrement();
            $table->string('nama_progres', 100)->nullable();
            $table->string('bukti_kompen', 255)->nullable();
            $table->char('UUID_Kompen', 36)->nullable();
            $table->string('ni', 18)->nullable();
            $table->string('nama', 100)->nullable();
            $table->integer('jam_kompen')->nullable(); // Added jam_kompen column
            $table->boolean('status_acc')->nullable(); // Added status_acc column
            $table->timestamps();

            $table->foreign('UUID_Kompen')->references('UUID_Kompen')->on('t_kompen')->onDelete('set null');
            $table->foreign('ni')->references('ni')->on('m_user')->onDelete('set null');
            $table->foreign('jam_kompen')->references('jam_kompen')->on('t_kompen')->onDelete('set null'); // Added foreign key reference to t_kompen
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_progres_kompen');
    }
};
