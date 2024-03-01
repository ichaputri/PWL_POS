<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stock = [
            [
                'stock_id' => 1,
                'barang_id' => 1,
                'user_id' => 1,
                'stok_tanggal' => '2024-01-01',
                'stok_jumlah' => 50,
            ],
            [
                'stock_id' => 2,
                'barang_id' => 2,
                'user_id' => 2,
                'stok_tanggal' => '2024-02-05',
                'stok_jumlah' => 30,
            ],
            [
                'stock_id' => 3,
                'barang_id' => 3,
                'user_id' => 3,
                'stok_tanggal' => '2024-03-15',
                'stok_jumlah' => 40,
            ],
            [
                'stock_id' => 4,
                'barang_id' => 4,
                'user_id' => 1,
                'stok_tanggal' => '2024-04-20',
                'stok_jumlah' => 20,
            ],
            [
                'stock_id' => 5,
                'barang_id' => 5,
                'user_id' => 2,
                'stok_tanggal' => '2024-05-10',
                'stok_jumlah' => 60,
            ],
            [
                'stock_id' =>6 ,
                'barang_id' => 6,
                'user_id' => 3,
                'stok_tanggal' => '2024-06-25',
                'stok_jumlah' => 35,
            ],
            [
                'stock_id' =>7 ,
                'barang_id' => 7,
                'user_id' => 1,
                'stok_tanggal' => '2024-07-05',
                'stok_jumlah' => 25,
            ],
            [
                'stock_id' => 8,
                'barang_id' => 8,
                'user_id' => 2,
                'stok_tanggal' => '2024-08-18',
                'stok_jumlah' => 45,
            ],
            [
                'stock_id' =>9,
                'barang_id' => 9,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-30',
                'stok_jumlah' => 55,
            ],
            [
                'stock_id' => 10,
                'barang_id' => 10,
                'user_id' => 1,
                'stok_tanggal' => '2024-10-12',
                'stok_jumlah' => 70,
            ],
        ];

        DB::table('t_stock')->insert($stock);
    }
}
