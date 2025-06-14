<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Class BrandSeed extends Seeder {
    
    public function run () {

        DB::table('brand')->insert(
            [
                // 'id' => 01,
                'name' => 'SUNMIX',
                'permalink' => 'sunmix',
                'publish' => 1,
                'order_id' => 0,
                'meta_title' => 'SUNMIX', 
                'meta_description' => 'SUNMIX',
                'meta_keyword' => 'SUNMIX, MIXER, MIXER SUNMIX',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}