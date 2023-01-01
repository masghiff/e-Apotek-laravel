<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class KategoriSeeder extends Seeder
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
                'id' => '07718991-d5f9-4a15-8a2c-0cc014642596',
                'nama' => 'Obat Bebas',
                'status' => 'aktif',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'dd655080-9f5f-429b-9142-9f25ad4cb1f4',
                'nama' => 'Obat Keras',
                'status' => 'aktif',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => '3a452da5-b34a-42c4-994f-dc5f50c44925',
                'nama' => 'Obat Herbal',
                'status' => 'aktif',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];
        DB::table('kategoris')->insert($data);
    }
}
