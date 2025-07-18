<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdministratorModelSeeder extends Seeder {

    public function run(): void
    {
        AdministratorModelSeeder::create([
            'name' => 'Cahya',
            'email' => 'cahya@gmail.com',
            'password' => Hash::make('cahya123'), // encrypt password
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'remember_token' => 'cahya',
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
