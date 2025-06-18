<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Class ProductModelSeed extends Seeder 
{
    public function run () 
    {
        DB::table('product')->insert(
            [
                [
                    'category_id' => 12,
                    'brand_id' => 36,
                    'name' => 'EASY6 BIANCO',
                    'subtitle' => '',
                    'description' => '
                    description',
                    'video' => '',
                    'permalink' => 'easy-6-bianco',
                    'publish' =>1,
                    'order_category' =>0,
                    'order_brand' =>0,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'img' => 'EASY6_bianco.jpg',
                    'meta_title' => 'easy6 bianco',
                    'meta_keyword' => 'easy6, easy6 bianco, spiral mixer, 
                    spiral mixer jakarta, mesin bakery, mesin bakery jakarta',
                    'meta_description' => 'spiral mixer easy6 bianco' 
                ],     
                [
                    'category_id' => 12,
                    'brand_id' => 36,
                    'name' => 'EASY10 NERO',
                    'subtitle' => '',
                    'description' => '
                    description',
                    'video' => '',
                    'permalink' => 'easy-10-nero',
                    'publish' =>1,
                    'order_category' =>0,
                    'order_brand' =>0,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'img' => 'EASY10_nero.jpg',
                    'meta_title' => 'easy10 nero',
                    'meta_keyword' => 'easy10, easy10 nero, spiral mixer, 
                    spiral mixer jakarta, mesin bakery, mesin bakery jakarta',
                    'meta_description' => 'spiral mixer easy6 nero' 
                ], 
                [
                    'category_id' => 12,
                    'brand_id' => 36,
                    'name' => 'EASY15 ROSSO',
                    'subtitle' => '',
                    'description' => '
                    description',
                    'video' => '',
                    'permalink' => 'easy-15-rosso',
                    'publish' =>1,
                    'order_category' =>0,
                    'order_brand' =>0,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'img' => 'EASY15_rosso.jpg',
                    'meta_title' => 'easy15 rosso',
                    'meta_keyword' => 'easy15, easy15 rosso, spiral mixer, 
                    spiral mixer jakarta, mesin bakery, mesin bakery jakarta',
                    'meta_description' => 'spiral mixer easy15 rosso' 
                ],
                [
                    'category_id' => 12,
                    'brand_id' => 36,
                    'name' => 'EASY20 BIANCO',
                    'subtitle' => '',
                    'description' => '
                    description',
                    'video' => '',
                    'permalink' => 'easy-20-bianco',
                    'publish' =>1,
                    'order_category' =>0,
                    'order_brand' =>0,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'img' => 'EASY20_bianco.jpg',
                    'meta_title' => 'easy20 bianco',
                    'meta_keyword' => 'easy20, easy20 bianco, spiral mixer, 
                    spiral mixer jakarta, mesin bakery, mesin bakery jakarta',
                    'meta_description' => 'spiral mixer easy6 bianco' 
                ]
            ]
        );
    }
}