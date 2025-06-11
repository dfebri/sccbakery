<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Class CategoryModelSeed extends Seeder {
    
    public function run () {
        DB::table('category')->insert(
            [
                // 'id' => 01,
                'name' => 'PIZZA OVEN',
                'permalink' => 'pizza-oven',
                'publish' => 1,
                'order_id' => 0,
                'meta_title' => 'PIZZA OVEN', 
                'meta_description' => 'PIZZA OVEN, EFFE UNO',
                'meta_keyword' => 'PIZZA OVEN, EFFE UNO, OVEN JAKARTA',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}