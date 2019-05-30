<?php

use Illuminate\Database\Seeder;
use App\ProductSize;

class ProductSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
        	['id' => 1, 'name' => 'P', 'product_id' => 1],
        	['id' => 2, 'name' => 'M', 'product_id' => 1],
        	['id' => 3, 'name' => 'G', 'product_id' => 1],
        	['id' => 4, 'name' => 'GG', 'product_id' => 1],
        	['id' => 5, 'name' => 'P', 'product_id' => 2],
        	['id' => 6, 'name' => 'M', 'product_id' => 2],
        	['id' => 7, 'name' => 'G', 'product_id' => 2],
        	['id' => 8, 'name' => 'P', 'product_id' => 3],
        	['id' => 9, 'name' => 'M', 'product_id' => 3],
        	['id' => 10, 'name' => 'G', 'product_id' => 3],
        	['id' => 11, 'name' => 'GG', 'product_id' => 3],
        	['id' => 12, 'name' => 'P', 'product_id' => 5],
        	['id' => 13, 'name' => 'M', 'product_id' => 5],
        	['id' => 14, 'name' => 'G', 'product_id' => 5],
        	['id' => 15, 'name' => 'P', 'product_id' => 6],
        	['id' => 16, 'name' => 'M', 'product_id' => 6],
        	['id' => 17, 'name' => 'G', 'product_id' => 6],
        	['id' => 18, 'name' => 'GG', 'product_id' => 6],
        	['id' => 19, 'name' => 'P', 'product_id' => 7],
        	['id' => 20, 'name' => 'M', 'product_id' => 7],
        	['id' => 21, 'name' => 'G', 'product_id' => 7],
        	['id' => 22, 'name' => 'P', 'product_id' => 10],
        	['id' => 23, 'name' => 'M', 'product_id' => 10],
        	['id' => 24, 'name' => 'G', 'product_id' => 10]
        ];

        ProductSize::insert($sizes);
    }
}
