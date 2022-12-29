<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
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
                'id' => 'f5be3b89-820f-4637-b15b-c42861c4b60d',
                'username' => 'globaladmin',
                'password' => Hash::make('12345678'),
                'nama' => 'global admin',
                'foto' => 'assets/img/admin.png',
                'role' => 'admin',
                'membership' => '-',
                'point' => '-',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'a9fc2932-9525-42c9-bee4-86e3d1563fbc',
                'username' => 'ghifari',
                'password' => Hash::make('12345678'),
                'nama' => 'Ghifari Kusuma',
                'foto' => 'assets/img/ghifari.png',
                'role' => 'admin',
                'membership' => 'SILVER',
                'point' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => '00765440-0e19-4fab-b008-ff9da17abae6',
                'username' => 'ivan',
                'password' => Hash::make('12345678'),
                'nama' => 'Theodorus Ivan',
                'foto' => 'assets/img/ivan.png',
                'role' => 'pelanggan',
                'membership' => 'SILVER',
                'point' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        DB::table('users')->insert($data);

    }
}
