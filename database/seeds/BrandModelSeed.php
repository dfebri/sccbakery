<?php

namespace Database\Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandModelSeed extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {   
            DB::table('brand')->insert(
                [
                    [
                        // 'id' => '',
                        'name' => 'NEWBRAND TOKYO SECOND',
                        'permalink' => 'newbrand-tokyo-second',
                        'publish' => 0,
                        'order_id' => 0,
                        'meta_title' => 'Tokyo Branded',
                        'meta_description' => 'Tokyo punya brand',
                        'meta_keyword' => 'newbrand tokyo',
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ]
                ]
            );
    }
}
