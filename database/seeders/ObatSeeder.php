<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class ObatSeeder extends Seeder
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
                'id' => 1,
                'nama' => 'Komix',
                'stok' => '100',
                'harga' => '2500',
                'kategori_id' => 1,
                'supplier_id'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'nama' => 'Panadol',
                'stok' => '90',
                'harga' => '5000',
                'kategori_id' => 2,
                'supplier_id'=> 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'nama' => 'Madu TJ',
                'stok' => '50',
                'harga' => '3000',
                'kategori_id' => 3,
                'supplier_id'=> 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        DB::table('obats')->insert($data);

    }
}
