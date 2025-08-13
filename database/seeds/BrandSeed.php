<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Class BrandSeed extends Seeder {
    
    public function run () {

        DB::table('brand')->insert(
            [
                'name' => 'MIMAX',
                'permalink' => 'mimax',
                'publish' => 1,
                'order_id' => 0,
                'meta_title' => 'MIMAX',
                'meta_description' => 'Discover best performance machine for bakery at SCC for your business',
                'meta_keyword' => 'SCCBAKERY, MIMAC, COOKIE DEPOSITOR, SUPEMA, MESIN BAKERY, MESIN BAKERY JAKARTA, MESIN BAKERY INDONESIA, MESIN BAKERY INTERNATIONAL, FOOD PROCESSING EQUIPMENT',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}