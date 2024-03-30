<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Menggunakan HasMany untuk relasi dengan UserModel

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'level_id'; // Nama primary key dari tabel yang digunakan
    protected $fillable = ['level_kode', 'level_nama']; // Kolom yang dapat diisi secara massal

    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id'); // Definisi relasi dengan UserModel
    }
}
 