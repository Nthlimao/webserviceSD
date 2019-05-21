<?php

namespace App\Http\Controllers;

use App\Category;
use Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
    	$categories = Category::all();
        
        return $this->success($categories);
    }

    public function show($id){
    	$category = Category::find($id);

        if ($category) {
            return $this->success($category);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Categoria Inválida');
        }
    }

    public function store(Request $request){
    	$category = new Category();

		$rules 	   = $category->rules();
		$messages  = $category->messages();
		$validator = Validator::make($request->all(), $rules, $messages);

		if ($validator->fails()) {
			return $this->error(self::VALIDATION_ERROR, $validator->errors()->first());		
		}

		$category->fill($request->all());
		$category->save();

        return $this->success($category);
    }

    public function update(Request $request, $id){
    	$category = Category::find($id);

        if (!$category) {
            return $this->error(self::INVALID_RESOURCE, 'Categoria Inválida');
        }

        $category->fill($request->all());
        $category->save();
        return $this->success($category);
    }

    public function destroy($id){
    	$category = Category::find($id);

        if ($category) {
            $category->delete();
            return $this->success('Categoria deletada com sucesso!');
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Categoria Inválida');
        }
    }
}
