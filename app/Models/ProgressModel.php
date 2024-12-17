<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KompenModel;
<<<<<<< HEAD
=======
use App\Models\MahasiswaAlpha;
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4

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
<<<<<<< HEAD
=======
        'kelas', // Adding kelas field
        'semester', // Adding semester field
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    ];

    public function kompen()
    {
        return $this->belongsTo(KompenModel::class, 'UUID_Kompen', 'UUID_Kompen');
    }

    public function user()
    {
<<<<<<< HEAD
        return $this->belongsTo(User::class, 'ni', 'ni');
=======
        return $this->belongsTo(UserModel::class, 'ni', 'ni');
    }

    public function mahasiswaAlpha()
    {
        return $this->belongsTo(MahasiswaAlpha::class, 'ni', 'ni')->where('semester', $this->semester);
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    }

    public function getJamKompenAttribute()
    {
        return $this->kompen ? $this->kompen->jam_kompen : null;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
