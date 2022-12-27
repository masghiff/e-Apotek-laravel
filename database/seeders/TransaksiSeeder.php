<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'nota' => '4KF9QBDJXY',
                'user_id' => 'a9fc2932-9525-42c9-bee4-86e3d1563fbc',
                'obat_id' => 'ea7dee69-3bc5-48ef-9441-c8f3d92cdd23',
                'jumlah' => '5',
                'total_harga' => '12500',
                'status' => 'sukses',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];
        DB::table('transaksis')->insert($data);
    }
}
