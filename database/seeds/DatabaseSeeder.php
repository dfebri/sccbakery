<?php

namespace Database\Seeds;

use Database\Seeders\BrandModelSeed as SeedersBrandModelSeed;
use Illuminate\Database\Seeder;
use Database\Seeds\AdministratorModelSeeder;
use Database\Seeds\BrandModelSeed;
use Database\Seeds\ProductModelSeed;
use Database\Seeds\CategoryModelSeed;

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call([
            AdministratorModelSeeder::class,
            BrandModelSeed::class,
            ProductModelSeed::class,
            CategoryModelSeed::class
        ]);
    }
}


