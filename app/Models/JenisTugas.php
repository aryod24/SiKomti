<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JenisTugas extends Model
{
    use HasFactory;

    protected $table = 'm_jenis_tugas'; // Nama tabel untuk jenis tugas
    protected $primaryKey = 'id_tugas'; // Primary key untuk tabel jenis tugas
    protected $fillable = [
        'jenis_tugas',
    ];

}