<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'kategori_id' =>1 ,
                'kategori_kode' => 'KTG001',
                'kategori_nama' => 'Makanan dan Minuman',
            ],
            [
                'kategori_id' =>2 ,
                'kategori_kode' => 'KTG002',
                'kategori_nama' => 'Elektronik dan Peralatan Rumah Tangga',
            ],
            [
                'kategori_id' =>3 ,
                'kategori_kode' => 'KTG003',
                'kategori_nama' => 'Pakaian dan Aksesoris',
            ],
            [
                'kategori_id' =>4 ,
                'kategori_kode' => 'KTG004',
                'kategori_nama' => 'Alat Tulis dan Kantor',
            ],
            [
                'kategori_id' =>5 ,
                'kategori_kode' => 'KTG005',
                'kategori_nama' => 'Mainan dan Perlengkapan Anak',
            ],
        ];

        DB::table('m_kategori')->insert($kategori); 
    }
}
