<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KompenModel;
use App\Models\MahasiswaAlpha;

class ProgressModel extends Model
{
    use HasFactory;

    protected $table = 't_progres_kompen';
    protected $primaryKey = 'id_progres';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nama_progres',
        'bukti_kompen',
        'UUID_Kompen',
        'ni',
        'nama',
        'jam_kompen',
        'status_acc',
        'kelas', // Adding kelas field
        'semester', // Adding semester field
    ];

    public function kompen()
    {
        return $this->belongsTo(KompenModel::class, 'UUID_Kompen', 'UUID_Kompen');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'ni', 'ni');
    }

    public function mahasiswaAlpha()
    {
        return $this->belongsTo(MahasiswaAlpha::class, 'ni', 'ni')->where('semester', $this->semester);
    }

    public function getJamKompenAttribute()
    {
        return $this->kompen ? $this->kompen->jam_kompen : null;
    }
}