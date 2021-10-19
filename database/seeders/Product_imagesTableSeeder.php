<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product_imagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_images')->insert([
            [
                'id' => 1,
                'img' => 'products/product_7.jpg',
                'product_id' => 1,
            ],
            [
                'id' => 2,
                'img' => 'products/product_6.jpg',
                'product_id' => 2,
            ],
            [
                'id' => 3,
                'img' => 'products/product_12.jpg',
                'product_id' => 3,
            ],
            [
                'id' => 4,
                'img' => 'products/product_10.jpg',
                'product_id' => 4,
            ],
        ]);
    }
}
