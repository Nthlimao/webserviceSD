<?php

use Illuminate\Database\Seeder;
use App\ProductColor;

class ProductColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
        	['id' => 1, 'name' => 'Preta', 'product_id' => 1],
        	['id' => 2, 'name' => 'Azul', 'product_id' => 2],
        	['id' => 3, 'name' => 'Preto', 'product_id' => 2],
        	['id' => 4, 'name' => 'Vermelho', 'product_id' => 2],
        	['id' => 5, 'name' => 'Rosa', 'product_id' => 2],
        	['id' => 6, 'name' => 'Branco', 'product_id' => 3],
        	['id' => 7, 'name' => 'Azul', 'product_id' => 3],
        	['id' => 8, 'name' => 'Preto', 'product_id' => 3],
        	['id' => 9, 'name' => 'Preto', 'product_id' => 4],
        	['id' => 10, 'name' => 'Vermelho', 'product_id' => 5],
        	['id' => 11, 'name' => 'Rosa', 'product_id' => 6],
        	['id' => 12, 'name' => 'Azul', 'product_id' => 6],
        	['id' => 13, 'name' => 'Vermelho', 'product_id' => 6],
        	['id' => 14, 'name' => 'Vinho', 'product_id' => 6],
        	['id' => 15, 'name' => 'Branca', 'product_id' => 7],
        	['id' => 16, 'name' => 'Cinza', 'product_id' => 7],
        	['id' => 17, 'name' => 'Azul', 'product_id' => 7],
        	['id' => 18, 'name' => 'Preta', 'product_id' => 8],
        	['id' => 19, 'name' => 'Azul', 'product_id' => 9],
        	['id' => 20, 'name' => 'Branco', 'product_id' => 10],
        	['id' => 21, 'name' => 'Mesclado', 'product_id' => 10],
        	['id' => 22, 'name' => 'Vinho', 'product_id' => 10]
        ];

        ProductColor::insert($colors);
    }
}
