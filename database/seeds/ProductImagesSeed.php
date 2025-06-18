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
                'product_id' => 165,
                'img' => 'EASY10_nero.jpg',
                'as_default' => 1,
                'order_id' => 0,
                'publish' =>1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'product_id' => 166,
                'img' => 'EASY15_rosso.jpg',
                'as_default' => 1,
                'order_id' => 0,
                'publish' =>1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], 
            [
                'product_id' => 167,
                'img' => 'EASY20_bianco.jpg',
                'as_default' => 1,
                'order_id' => 0,
                'publish' =>1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ], 
            [
                'product_id' => 164,
                'img' => 'EASY6_bianco.jpg',
                'as_default' => 1,
                'order_id' => 0,
                'publish' =>1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}



