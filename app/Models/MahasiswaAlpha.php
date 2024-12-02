<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaAlpha extends Model
{
    use HasFactory;

    protected $table = 'm_mahasiswa_alpha';
    protected $primaryKey = 'id_alpha'; 

    protected $fillable = [
        'ni',
        'jam_alpha',
        'nama',
        'semester',
        'jam_kompen',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'ni', 'ni');
    }
}
