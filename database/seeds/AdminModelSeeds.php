<?php 

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades
use Carbon\Carbon;

class AdminModelSeeds extends Seeder {

    public function run()
    {
        DB::table('administrator')->insert(
            [
                'name' => 'Febri',
                'email' => 'dwifebrimurcahyo@gmail.com',
                'password' => Hash::make('SCCbakery123'), //Encrypt
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'remember_token' => 'sccbakery'
            ]
        );
    }
}