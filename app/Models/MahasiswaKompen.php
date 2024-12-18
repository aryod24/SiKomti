<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MahasiswaKompen extends Model
{
    use HasFactory;

    protected $table = 'm_mahasiswa_kompen';

    protected $primaryKey = 'id_MahasiswaKompen';

    protected $fillable = [
        'ni',
        'UUID_Kompen',
        'nama',
        'status_Acc',
        'kelas', // Adding kelas field
        'semester', // Adding semester field
    ];

    // Relasi ke model LevelModel
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    // Relasi ke model KompenModel
    public function kompen(): BelongsTo
    {
        return $this->belongsTo(KompenModel::class, 'UUID_Kompen', 'UUID_Kompen');
    }

    // Relasi ke model ProgressModel
    public function progress(): HasOne
    {
        return $this->hasOne(ProgressModel::class, 'UUID_Kompen', 'UUID_Kompen');
    }

    // Relasi ke model UserModel
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'ni', 'ni');
    }
}
