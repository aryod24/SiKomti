<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaKompen extends Model
{
    use HasFactory;

    protected $table = 'm_mahasiswa_kompen';

    protected $primaryKey = 'id_MahasiswaKompen';

    protected $fillable = [
        'ni',
        'UUID_Kompen',
        'status_Acc',
    ];
}
