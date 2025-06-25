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
                    'brand_id' => 37,
                    'name' => 'MISS BAKER PRO',
                    'subtitle' => '',
                    'description' => '
                    description',
                    'video' => '',
                    'permalink' => 'miss-baker-pro',
                    'publish' =>1,
                    'order_category' =>0,
                    'order_brand' =>0,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'img' => 'MISS-BAKER-PRO.jpg',
                    'meta_title' => 'miss baker pro',
                    'meta_keyword' => 'bernadi, miss baker pro, spiral mixer, 
                    spiral mixer jakarta, mesin bakery, mesin bakery jakarta',
                    'meta_description' => 'spiral mixer bernadi miss baker pro' 
                ],     
                [
                    'category_id' => 12,
                    'brand_id' => 37,
                    'name' => 'MISS BAKER PRO XL',
                    'subtitle' => '',
                    'description' => '
                    description',
                    'video' => '',
                    'permalink' => 'miss-baker-pro-xl',
                    'publish' =>1,
                    'order_category' =>0,
                    'order_brand' =>0,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'img' => 'MISS-BAKER-PRO-XL.jpg',
                    'meta_title' => 'miss baker pro xl',
                    'meta_keyword' => 'bernadi, miss baker pro xl, spiral mixer, 
                    spiral mixer jakarta, mesin bakery, mesin bakery jakarta',
                    'meta_description' => 'spiral mixer bernadi miss baker pro xl' 
                ] 
            ]
        );
    }
}