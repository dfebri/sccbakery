<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Class ProductImagesSeed extends Seeder 

{
    public function run () 
    {
        DB::table('product_image')->insert(
        [
            [
                'product_id' => 167,
                'img' => 'MISS-BAKER-PRO.jpg',
                'as_default' => 1,
                'order_id' => 0,
                'publish' =>1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'product_id' => 168,
                'img' => 'MISS-BAKER-PRO-XL.jpg',
                'as_default' => 1,
                'order_id' => 0,
                'publish' =>1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ] 
        ]);
    }
}



