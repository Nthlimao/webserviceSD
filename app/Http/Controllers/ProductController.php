<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use Validator;

use App\Product;
use App\ProductColor;
use App\ProductSize;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
    	$products = Product::with('category')->get();
        
        return $this->success($products);
    }

    public function show($id){
    	$product = Product::with(['category', 'photos'])->find($id);

        if ($product) {
            return $this->success($product);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Produto inválido');
        }
    }

    public function store(Request $request){
        DB::beginTransaction(); 

        try {

        	$product = new Product();

    		$rules 	   = $product->rules();
    		$messages  = $product->messages();
    		$validator = Validator::make($request->all(), $rules, $messages);

    		if ($validator->fails()) {
    			return $this->error(self::VALIDATION_ERROR, $validator->errors()->first());		
    		}

    		$product->fill($request->all());

    		if($product->name) {
    			$product->permanent_link = Str::slug($product->name, '-');
    		}

    		$product->save();
            $this->saveColors($request, $product);
            $this->saveSizes($request, $product);
            DB::commit();

            return $this->success('Produto criado com sucesso!');
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    private function saveColors(Request $request, Product $product){
        $colors = $request->input('colors', []);
        $oldcolors = [];

        foreach ($colors as $item) {
            if (isset($item['id'])) {
                $oldcolors[] = $item['id'];
            }
        }

        if (count($oldcolors) > 0) {
            ProductColor::where('product_id', $product->id)->whereNotIn('id', $oldcolors)->delete();
        } else {
            ProductColor::where('product_id', $product->id)->delete();
        }

        foreach ($colors as $item) {
            $color = (isset($item['id'])) ? ProductColor::find($item['id']) : new ProductColor();

            $color->fill($item);
            $color->product_id = $product->id;
            $color->save();
        }
    }

    private function saveSizes(Request $request, Product $product){
        $sizes = $request->input('sizes', []);
        $oldsizes = [];

        foreach ($sizes as $item) {
            if (isset($item['id'])) {
                $oldsizes[] = $item['id'];
            }
        }

        if (count($oldsizes) > 0) {
            ProductSize::where('product_id', $product->id)->whereNotIn('id', $oldsizes)->delete();
        } else {
            ProductSize::where('product_id', $product->id)->delete();
        }

        foreach ($sizes as $item) {
            $size = (isset($item['id'])) ? ProductSize::find($item['id']) : new ProductSize();

            $size->fill($item);
            $size->product_id = $product->id;
            $size->save();
        }
    }

    public function update(Request $request, $id){
    	$product = Product::find($id);

        if (!$product) {
            return $this->error(self::INVALID_RESOURCE, 'Produto Inválido');
        }

        $product->fill($request->all());

        if($product->name) {
			$product->permanent_link = Str::slug($product->name, '-');
		}

        $product->save();
        return $this->success($product);
    }

    public function destroy($id){
    	$product = Product::find($id);

        if ($product) {
            $product->delete();
            return $this->success('Produto deletado com sucesso!');
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Produto inválido');
        }
    }

}