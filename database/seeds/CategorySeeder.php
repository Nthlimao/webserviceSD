<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$categories = [
    		['id' => 1, 'name' => 'Camisa'],
    		['id' => 2, 'name' => 'Camisa Pólo'],
    		['id' => 3, 'name' => 'Regata'],
    		['id' => 4, 'name' => 'Moletom'],
    		['id' => 5, 'name' => 'Jaqueta'],
    		['id' => 6, 'name' => 'Pijama'],
    		['id' => 7, 'name' => 'Mochila Saco']
            ['id' => 8, 'name' => 'Boné']
    	];

        Category::insert($categories);        
    }
}
