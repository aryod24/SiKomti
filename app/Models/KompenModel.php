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
        'is_selesai', 
        'id_kompetensi',
        'periode_kompen',
        'nama', 
        'user_id',
        'level_id', 
        'created_at',
        'updated_at'
    ];

    // Relasi ke model LevelModel
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    // Relasi ke model UserModel
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Relasi ke model Kompetensi
    public function kompetensi(): BelongsTo
    {
        return $this->belongsTo(Kompetensi::class, 'id_kompetensi', 'id_kompetensi');
    }

    // Relasi ke model JenisTugas
    public function jenisTugas(): BelongsTo
    {
        return $this->belongsTo(JenisTugas::class, 'jenis_tugas', 'id_tugas');
    }

    // Relasi ke MahasiswaKompen
    public function mahasiswaKompens(): HasMany
    {
        return $this->hasMany(MahasiswaKompen::class, 'UUID_Kompen', 'UUID_Kompen');
    }

    // Relasi ke ProgressModel
    public function progresKompen(): HasMany
    {
        return $this->hasMany(ProgressModel::class, 'UUID_Kompen', 'UUID_Kompen');
    }

    // Getter untuk nama periode kompen
    public function getPeriodName(): string
    {
        return $this->periode_kompen;
    }

    // Cek apakah kompen ini sudah selesai
    public function isCompleted(): bool
    {
        return $this->is_selesai == 1; // 1 berarti selesai
    }
}
