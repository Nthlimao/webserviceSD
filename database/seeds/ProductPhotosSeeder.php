<?php

use Illuminate\Database\Seeder;
use App\ProductPhoto;

class ProductPhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photos = [
        	['id' => 1, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/p/r/preto_1_96.jpg', 'product_id' => 2],
        	['id' => 2, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/v/e/vermelho_1_90.jpg', 'product_id' => 2],
        	['id' => 3, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/r/o/rosa_1_95.jpg', 'product_id' => 2],
        	['id' => 4, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/a/z/azul_1_338.jpg', 'product_id' => 3],
        	['id' => 5, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/p/r/preto_1_334.jpg', 'product_id' => 3],
        	['id' => 6, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/8/_/8_-_direito-lateral.png', 'product_id' => 4],
        	['id' => 7, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/9/_/9_-_direito-verso.png', 'product_id' => 4],
        	['id' => 8, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/b/e/bermuda-m-fem-agronomia_02.png', 'product_id' => 5],
        	['id' => 9, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/b/e/bermuda-m-fem-agronomia_03.png', 'product_id' => 5],
        	['id' => 10, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/c/a/canguru-raglan-cores-site-base_01_18.png', 'product_id' => 6],
        	['id' => 11, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/c/a/canguru-raglan-cores-site-base_06_18.png', 'product_id' => 6],
        	['id' => 12, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/c/a/canguru-raglan-cores-site-base_07_18.png', 'product_id' => 6],
        	['id' => 13, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/2/_/2_35.png', 'product_id' => 7],
        	['id' => 14, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/3/_/3_35.png', 'product_id' => 7],
        	['id' => 15, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/b/e/bermuda-m-contabeis_02.png', 'product_id' => 9],
        	['id' => 16, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/b/e/bermuda-m-contabeis_03.png', 'product_id' => 9],
        	['id' => 18, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/m/e/mescla_199.jpg', 'product_id' => 10],
        	['id' => 19, 'photo_url' => 'https://www.rstextil.com.br/media/catalog/product/cache/1/image/17f82f742ffe127f42dca9de82fb58b1/v/i/vinho_134.jpg', 'product_id' => 10]
        ];

        ProductPhoto::insert($photos);
    }
}
