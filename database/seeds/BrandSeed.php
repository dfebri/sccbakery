<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Class BrandSeed extends Seeder {
    
    public function run () {

        DB::table('brand')->insert(
            [
                'name' => 'BRESSO',
                'permalink' => 'bresso',
                'publish' => 1,
                'order_id' => 1,
                'meta_title' => 'bresso',
                'meta_description' => 'Discover best performance machine for bakery at SCC for your business',
                'meta_keyword' => 'SCCBAKERY, BRESSO, AUTOMATIC GAS OVEN 3 DECK, MESIN BAKERY, MESIN BAKERY JAKARTA, MESIN BAKERY INDONESIA, MESIN BAKERY INTERNATIONAL',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'PIZZA MASTER',
                'permalink' => 'pizza-master',
                'publish' => 1,
                'order_id' => 1,
                'meta_title' => 'PIZZA MASTER',
                'meta_description' => 'Discover best performance machine for bakery at SCC for your business',
                'meta_keyword' => 'SCCBAKERY, BRESSO, AUTOMATIC GAS OVEN 3 DECK, MESIN BAKERY, MESIN BAKERY JAKARTA, MESIN BAKERY INDONESIA, MESIN BAKERY INTERNATIONAL',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}