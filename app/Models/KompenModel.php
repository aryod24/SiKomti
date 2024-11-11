<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KompenModel extends Model
{
    use HasFactory;

    protected $table = 't_kompen'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'UUID_Kompen'; // Primary key untuk tabel kompen
    public $incrementing = false; // Jika UUID digunakan sebagai primary key, set false
    protected $keyType = 'string'; // Menentukan tipe primary key sebagai string (UUID)
    protected $fillable = [
        'UUID_Kompen', 
        'nama_kompen', 
        'deskripsi', 
        'jenis_tugas', 
        'quota', 
        'jam_kompen', 
        'status_dibuka', 
        'tanggal_mulai', 
        'tanggal_akhir', 
        'Is_Selesai', 
        'periode_kompen',
        'created_at',
        'updated_at'
    ];

    // Relasi ke model LevelModel, jika diperlukan
    public function level() : BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    // Relasi ke model UserModel jika dosen/mahasiswa berhubungan dengan kompen
    public function user() : BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
    // Getter untuk nama periode kompen
    public function getPeriodName(): string
    {
        return $this->periode_kompen;
    }

    // Cek apakah kompen ini sudah selesai
    public function isCompleted(): bool
    {
        return $this->Is_Selesai == 1; // 1 berarti selesai
    }
}