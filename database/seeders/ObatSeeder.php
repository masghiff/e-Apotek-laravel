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
                'id' => 'ea7dee69-3bc5-48ef-9441-c8f3d92cdd23',
                'nama' => 'Komix',
                'stok' => '100',
                'harga' => '2500',
                'foto' => 'komix.png',
                'status' => 'aktif',
                'kategori_id' => '07718991-d5f9-4a15-8a2c-0cc014642596',
                'supplier_id'=> '7effd9b8-deaa-4746-905f-11fd1734eec1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'd6950e54-8fbd-48f6-8486-da6cbf8f53aa',
                'nama' => 'Panadol',
                'stok' => '90',
                'harga' => '5000',
                'foto' => 'panadol.png',
                'status' => 'aktif',
                'kategori_id' => 'dd655080-9f5f-429b-9142-9f25ad4cb1f4',
                'supplier_id'=> 'a254d998-6a02-4ab1-9ee6-5dd5338b52dc',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => '24c68df4-5a1a-41d8-a09e-0638b4f63bd6',
                'nama' => 'Madu TJ',
                'stok' => '50',
                'harga' => '3000',
                'foto' => 'madutj.png',
                'status' => 'aktif',
                'kategori_id' => '3a452da5-b34a-42c4-994f-dc5f50c44925',
                'supplier_id'=> '1d2c92ee-e9c4-4a5d-a904-bb9e83ce4f0d',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        DB::table('obats')->insert($data);

    }
}
