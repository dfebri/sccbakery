<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use sccbakery\Admin\Models\AdministratorModel;

class AdministratorModelSeed extends Seeder {

    public function run()
    {
        DB::table('administrator')->insert([
            [
                'name' => 'Febri',
                'email' => 'dwifebrimurcahyo@gmail.com',
                'password' => Hash::make('SCCbakery123'), // Mengenkripsi password
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'remember_token' => 'sccbakery'
            ],
        ]);
    }
}


// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
// use Database\Seeds\AdministratorModelSeeder;

// class AdministratorModelSeeder extends Seeder {
    
//     public function run(): void
//     {
//         DB::table('administrator')->insert(
//         [
//             [
//                 // 'id' => 4,
//                 'name' => 'febri',
//                 'email' => 'dwifebrimurcahyo@gmail.com',
//                 'password' => 'SCCbakery123',
//                 // 'last_login' => '',
//                 // 'active' => '1',
//                 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                 'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
//                 'remember_token' => 'sccbakery'
//             ],
//         ]);
//     }
// }
