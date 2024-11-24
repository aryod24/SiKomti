<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];

    // Relasi ke model LevelModel
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}