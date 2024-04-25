<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Model implements AuthenticatableContract, JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    use Authenticatable;
    protected $table = 'm_user'; //mendefinidikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id'; //mendefinisikan primary key dari tabel yang digunakan
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['level_id', 'username', 'nama', 'password'];
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
