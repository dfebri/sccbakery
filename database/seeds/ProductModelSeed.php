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
                    'brand_id' => 23,
                    'name' => 'EFFE UNO',
                    'subtitle' => 'DK5-1P',
                    'description' => '
                    <table>
                        <tbody>
                        <tr>
                        <td>Capacity</td>
                        <td>:</td>
                        <td>2 trays 40 x 60 or 4 trays 40 x 60 &nbsp; (mm)</td>
                        </tr>
                        <tr>
                        <td>Dimension 1370 x 958 x 520 (mm) or 1820 x 958 x 520 (mm) or</td>
                        <td>:</td>
                        <td>Exterior: L1890 x D1030 x H1842 (mm)<br /> Interior: L1455 x D788 x H180 (mm)</td>
                        </tr>
                        <tr>
                        <td>Accessories</td>
                        <td>:</td>
                        <td>Stone (per deck)</td>
                        </tr>
                        <tr>
                        <td>&nbsp;</td>
                        <td>Steam Injection (per deck)</td>
                        </tr>
                        <tr>
                        <td>Power&nbsp;</td>
                        <td>:</td>
                        <td>1P 100W, without steam</td>
                        </tr>
                        <tr>
                        <td>Weight</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                        </tr>
                        <tr>
                        <td>Remarks</td>
                        <td>:</td>
                        <td>Full Body Stainless Steel</td>
                        </tr>
                        <tr>
                        <td>BRAND</td>
                        <td>:</td>
                        <td>JENDAH - TAIWAN</td>
                        </tr>
                        </tbody>
                    </table>
                    <p>&nbsp;</p>',
                    'video' => '',
                    'permalink' => 'gas-deck-oven-gt-1002',
                    'publish' => 1,
                    'order_category' =>0,
                    'order_brand' =>0,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'img' => 'gas-rotary-rack-oven.jpg',
                    'meta_title' => 'Gas Deck Oven',
                    'meta_keyword' => 'Gas Deck Oven, Mesin Bakery, Mesin Bakery Jakarta',
                    'meta_description' => 'Gas Deck Oven Mesin Bakery'
                    
                ]
            ]
        );
    }
}