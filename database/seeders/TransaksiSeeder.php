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
                'membership_id' => 1,
                'obat_id' => 1,
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
