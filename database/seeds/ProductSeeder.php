<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
        	['id' => 1, 'name' => 'Camisa Coração Ciência da Computação', 'category_id' => 1, 'featured_photo_url' => 'https://www.rstextil.com.br/camiseta-coracao-ciencia-da-computacao', 'permanent_link' => 'camisa-coracao-ciencia-da-computacao', 'price' => 49.90, 'quantity' => 10, 'reference' => '75012019'],
        	['id' => 2, 'name' => 'Jaqueta College Ciência da Computação', 'category_id' => 5, 'featured_photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/a/z/azul_1_96.jpg', 'permanent_link' => 'jaqueta-college-ciencia-da-computacao', 'price' => 159.90, 'quantity' => 10, 'reference' => '687380220'],
        	['id' => 3, 'name' => 'Pólo Bordada Ciência da Computação', 'category_id' => 2, 'featured_photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/b/r/branco_337.jpg', 'permanent_link' => 'polo-bordada-ciencia-da-computacao', 'price' => 54.90, 'quantity' => 10, 'reference' => '942447557'],
        	['id' => 4, 'name' => 'Boné Bordado Direito', 'category_id' => 8, 'featured_photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/7/_/7_-_direito-frente.png', 'permanent_link' => 'bone-bordado-direito', 'price' => 59.90, 'quantity' => 10, 'reference' => '1234567937'],
        	['id' => 5, 'name' => 'Short-doll Agronomia', 'category_id' => 6, 'featured_photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/b/e/bermuda-m-fem-agronomia_01.png', 'permanent_link' => 'short-doll-agronomia', 'price' => , 'quantity' => 10, 'reference' => '1830201845'],
        	['id' => 6, 'name' => 'Moletom Raglan Personalizado Pedagogia', 'category_id' => 4, 'featured_photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/c/a/canguru-raglan-cores-site-base_04_18.png', 'permanent_link' => 'moletom-raglan-pedagogia', 'price' => 124.80, 'quantity' => 10, 'reference' => '21'],
        	['id' => 7, 'name' => 'Regata Estampada Geologia', 'category_id' => 3, 'featured_photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/1/_/1_35.png', 'permanent_link' => 'regata-estampada-geologia', 'price' => 42.90, 'quantity' => 10, 'reference' => '99'],
        	['id' => 8, 'name' => 'Mochila Saco Química', 'category_id' => 7, 'featured_photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/b/o/bolsas_01_7_.png', 'permanent_link' => 'mochila-quimica', 'price' => 29.90, 'quantity' => 10, 'reference' => '72536421'],
        	['id' => 9, 'name' => 'Samba-Canção Ciências Contábeis', 'category_id' => 6, 'featured_photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/b/e/bermuda-m-contabeis_01.png', 'permanent_link' => 'samba-cancao-ciencias-contabeis', 'price' => 49.90, 'quantity' => 10, 'reference' => '28092018'],
        	['id' => 10, 'name' => 'Moletom Bordado Ciência da Computação', 'category_id' => 4, 'featured_photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/b/r/branco_213.jpg', 'permanent_link' => 'moletom-bordado-ciencia-da-computacao', 'price' => 114.90, 'quantity' => 10, 'reference' => '67005545']
        ];
    }
}
