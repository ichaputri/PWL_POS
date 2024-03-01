<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penjualan = [
            [
                'penjualan_id' =>1,
                'user_id' => 1,
                'pembeli' => 'John Doe',
                'penjualan_kode' => 'PJL001',
                'penjualan_tanggal' => '2024-01-01',
            ],
            [
                'penjualan_id' =>2,
                'user_id' => 2,
                'pembeli' => 'Jane Smith',
                'penjualan_kode' => 'PJL002',
                'penjualan_tanggal' => '2024-02-05',
            ],
            [
                'penjualan_id' =>3,
                'user_id' => 3,
                'pembeli' => 'Alice Johnson',
                'penjualan_kode' => 'PJL003',
                'penjualan_tanggal' => '2024-03-15',
            ],
            [
                'penjualan_id' =>4,
                'user_id' => 1,
                'pembeli' => 'Bob Brown',
                'penjualan_kode' => 'PJL004',
                'penjualan_tanggal' => '2024-04-20',
            ],
            [
                'penjualan_id' =>5,
                'user_id' => 2,
                'pembeli' => 'Emily Davis',
                'penjualan_kode' => 'PJL005',
                'penjualan_tanggal' => '2024-05-10',
            ],
            [
                'penjualan_id' =>6,
                'user_id' => 3,
                'pembeli' => 'Michael Wilson',
                'penjualan_kode' => 'PJL006',
                'penjualan_tanggal' => '2024-06-25',
            ],
            [
                'penjualan_id' =>7,
                'user_id' => 1,
                'pembeli' => 'Olivia Taylor',
                'penjualan_kode' => 'PJL007',
                'penjualan_tanggal' => '2024-07-05',
            ],
            [
                'penjualan_id' =>8,
                'user_id' => 2,
                'pembeli' => 'William Martinez',
                'penjualan_kode' => 'PJL008',
                'penjualan_tanggal' => '2024-08-18',
            ],
            [
                'penjualan_id' =>9,
                'user_id' => 3,
                'pembeli' => 'Sophia Anderson',
                'penjualan_kode' => 'PJL009',
                'penjualan_tanggal' => '2024-09-30',
            ],
            [
                'penjualan_id' =>10,
                'user_id' => 1,
                'pembeli' => 'James Garcia',
                'penjualan_kode' => 'PJL010',
                'penjualan_tanggal' => '2024-10-12',
            ],
        ];

        DB::table('t_penjualan')->insert($penjualan);
    }
}
