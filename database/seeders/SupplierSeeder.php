<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
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
                'id' => '7effd9b8-deaa-4746-905f-11fd1734eec1',
                'nama' => 'JAYA ABADI',
                'status' => 'aktif',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'a254d998-6a02-4ab1-9ee6-5dd5338b52dc',
                'nama' => 'BAROKAH',
                'status' => 'aktif',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => '1d2c92ee-e9c4-4a5d-a904-bb9e83ce4f0d',
                'nama' => 'KARTINI',
                'status' => 'aktif',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];
        DB::table('suppliers')->insert($data);
    }
}
