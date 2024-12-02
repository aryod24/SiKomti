<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KompenModel;

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
    ];

    public function kompen()
    {
        return $this->belongsTo(KompenModel::class, 'UUID_Kompen', 'UUID_Kompen');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ni', 'ni');
    }

    public function getJamKompenAttribute()
    {
        return $this->kompen ? $this->kompen->jam_kompen : null;
    }
}
