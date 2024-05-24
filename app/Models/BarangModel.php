<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BarangModel extends Model
{
    protected $table = 'm_barang'; // Ganti 'm_barang' dengan nama tabel yang sesuai

    protected $primaryKey = 'barang_id'; // Jika nama primary key berbeda, sesuaikan dengan nama primary key yang benar

    protected $fillable = [
        'barang_kode',
        'kategori_id',
        'barang_nama',
        'harga_beli',
        'harga_jual',
        'image'
    ];

    // Relasi dengan model Kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    // protected function image(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($image) => url('/storage/posts/' . $image),
    //     );
    // }
}
