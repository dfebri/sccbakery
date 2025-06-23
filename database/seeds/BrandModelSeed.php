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
                'name' => 'BERNADI',
                'permalink' => 'bernadi',
                'publish' => 1,
                'order_id' => 0,
                'meta_title' => 'BERNADI',
                'meta_description' => 'BERNADI SPIRAL MIXER',
                'meta_keyword' => 'SCCBAKERY, SPIRAL MIXER, MESIN BAKERY, MESIN BAKERY JAKARTA, MESIN BAKERY INTERNATIONAL',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]  
        );
    }
}
