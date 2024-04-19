<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetailModel extends Model
{
    protected $table = 't_penjualan_detail'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'detail_id'; // Nama primary key dari tabel yang digunakan
    protected $fillable = ['penjualan_id', 'barang_id', 'harga', 'jumlah']; // Kolom yang dapat diisi secara massal

    // Tambahkan relasi ke T_penjualan jika diperlukan
    public function sale()
    {
        return $this->belongsTo(PenjualanModel::class, 'penjualan_id', 'penjualan_id');
    }

    // Tambahkan relasi ke BarangModel jika diperlukan
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }
}
