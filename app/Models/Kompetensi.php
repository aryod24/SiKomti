<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    use HasFactory;

    protected $table = 'm_bidang_kompetensi';
    protected $primaryKey = 'id_kompetensi';

    protected $fillable = [
        'nama_kompetensi',
    ];

}
