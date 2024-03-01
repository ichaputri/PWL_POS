<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = [
            [
                'barang_id' => 1,
                'kategori_id' => 1, // ID kategori Makanan dan Minuman
                'barang_kode' => 'BRG001',
                'barang_nama' => 'Susu cair',
                'harga_beli' => 10000,
                'harga_jual' => 12000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 2, // ID kategori Elektronik dan Peralatan Rumah Tangga
                'barang_kode' => 'BRG002',
                'barang_nama' => 'Televisi LED',
                'harga_beli' => 2000000,
                'harga_jual' => 2500000,
            ],
            // Data barang lainnya
            [
                'barang_id' => 3,
                'kategori_id' => 3, // ID kategori Pakaian dan Aksesoris
                'barang_kode' => 'BRG003',
                'barang_nama' => 'Kaos lengan pendek',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
            ],
            // Data barang lainnya
            [
                'barang_id' => 4,
                'kategori_id' => 4, // ID kategori Alat Tulis dan Kantor
                'barang_kode' => 'BRG004',
                'barang_nama' => 'Pulpen gel',
                'harga_beli' => 5000,
                'harga_jual' => 7000,
            ],
            // Data barang lainnya
            [
                'barang_id' => 5,
                'kategori_id' => 5, // ID kategori Mainan dan Perlengkapan Anak
                'barang_kode' => 'BRG005',
                'barang_nama' => 'Boneka beruang',
                'harga_beli' => 100000,
                'harga_jual' => 150000,
            ],
            // Data barang lainnya
            [
                'barang_id' => 6,
                'kategori_id' => 3, // ID kategori Pakaian dan Aksesoris
                'barang_kode' => 'BRG006',
                'barang_nama' => 'Jepit Rambut',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
            ],
            // Data barang lainnya
            [
                'barang_id' => 7,
                'kategori_id' => 5, // ID kategori Mainan dan Perlengkapan Anak
                'barang_kode' => 'BRG007',
                'barang_nama' => 'Mainan Kucing',
                'harga_beli' => 25000,
                'harga_jual' => 35000,
            ],
            // Data barang lainnya
            [
                'barang_id' => 8,
                'kategori_id' => 4, // ID kategori Buku dan Media
                'barang_kode' => 'BRG008',
                'barang_nama' => 'Tas ransel',
                'harga_beli' => 200000,
                'harga_jual' => 300000,
            ],
            // Data barang lainnya
            [
                'barang_id' => 9,
                'kategori_id' => 3, // ID kategori Pakaian dan Aksesoris
                'barang_kode' => 'BRG009',
                'barang_nama' => 'Sepatu sneakers',
                'harga_beli' => 150000,
                'harga_jual' => 225000,
            ],
            // Data barang lainnya
            [
                'barang_id' => 10,
                'kategori_id' => 2, // ID kategori Elektronik dan Peralatan Rumah Tangga
                'barang_kode' => 'BRG010',
                'barang_nama' => 'Smartphone',
                'harga_beli' => 3000000,
                'harga_jual' => 3500000,
            ],
        ];

        DB::table('m_barang')->insert($barang);
    }
}
