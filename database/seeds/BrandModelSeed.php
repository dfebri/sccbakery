<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandModelSeed extends Seeder
{
    public function run()
    {   
        DB::table('brand')->insert(
            [ 
                // 'id' => '',
                'name' => 'EFFE UNO',
                'permalink' => 'effe-uno',
                'publish' => 1,
                'order_id' => 0,
                'meta_title' => 'EFFE UNO',
                'meta_description' => 'SCCBAKERY, OVEN EFFE UNO',
                'meta_keyword' => 'SCCBAKERY, OVEN EFFE UNO, OVEN JAKARTA',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]  
        );
    }
}
