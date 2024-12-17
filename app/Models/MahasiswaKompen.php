<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\HasOne;
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4

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
<<<<<<< HEAD
=======
        'kelas', // Adding kelas field
        'semester', // Adding semester field
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
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
<<<<<<< HEAD
    public function progress()
{
    return $this->hasOne(ProgressModel::class, 'UUID_Kompen', 'UUID_Kompen');
}
}
=======

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
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
