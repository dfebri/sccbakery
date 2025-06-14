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
                    'name' => 'SUN6',
                    'subtitle' => '',
                    'description' => '
                    <div>
                        Weight: &nbsp;<br />
                        Power : &nbsp;<br />
                        Max temperature       : &nbsp;<br />
                        Dimensions (LxPxA)    : &nbsp;<br />
                        Electric Power Supply : &nbsp;<br />
                        <div>&nbsp;</div>
                        <div>Accessories : </div>
                        <div>&nbsp;
                    </div>
                    <p>&nbsp;</p>',
                    'video' => '',
                    'permalink' => 'sun6',
                    'publish' => 1,
                    'order_category' =>0,
                    'order_brand' =>0,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'img' => 'sunmix lavender.jpg',
                    'meta_title' => 'PIZZA OVEN',
                    'meta_keyword' => 'Pizaa Oven, Mesin Bakery, Mesin Bakery Jakarta',
                    'meta_description' => 'Deck Oven Mesin Bakery'
                    
                ]
            ]
        );
    }
}