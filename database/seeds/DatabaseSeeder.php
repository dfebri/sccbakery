<?php

namespace Database\Seeds;

use Database\Seeders\BrandModelSeed as SeedersBrandModelSeed;
use Illuminate\Database\Seeder;
use Database\Seeds\AdministratorModelSeeder;
use Database\Seeds\BrandModelSeed;
use Database\Seeds\ProductModelSeed;
use Database\Seeds\CategoryModelSeed;
use Database\Seeds\BrandSeed;
use Database\Seeds\ProductImagesSeed;


class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call([
            AdministratorModelSeeder::class,
            BrandModelSeed::class,
            ProductModelSeed::class,
            CategoryModelSeed::class,
            BrandSeed::class,
            ProductImagesSeed::class
        ]);
    }
}


