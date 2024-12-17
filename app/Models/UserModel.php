<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany for the new relationship
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable implements JWTSubject
{
<<<<<<< HEAD
    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return [];
    }
    use HasFactory, HasApiTokens;

    protected $table = 'm_user';        // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id';  // Mendfinisikan primary key dari tabel yang digunakan
    protected $fillable = ['username', 'password', 'nama', 'jurusan', 'ni', 'level_id','avatar','created_at', 'updated_at'];
=======
    use HasFactory, HasApiTokens;

    protected $table = 'm_user';        // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id';  // Mendefinisikan primary key dari tabel yang digunakan
    protected $fillable = ['username', 'password', 'nama', 'jurusan', 'ni', 'level_id', 'avatar', 'kelas', 'semester', 'created_at', 'updated_at'];
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function getJWTIdentifier(){
        return $this->getKey();
    }

<<<<<<< HEAD
=======
    public function getJWTCustomClaims(){
        return [];
    }

    // Relasi ke model LevelModel
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
<<<<<<< HEAD
=======

    // Relasi ke model KompenModel
    public function kompens(): HasMany
    {
        return $this->hasMany(KompenModel::class, 'user_id', 'user_id');
    }

>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }
<<<<<<< HEAD
=======

>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }
<<<<<<< HEAD
=======

>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
    public function getRole()
    {
        return $this->level->level_kode;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 2c64608886508e017e155a04be3170f2d8927dc4
