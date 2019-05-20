<?php

namespace App\Http\Controllers;


use App\Order;
use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
    	$stores = Store::all();
        
        return $this->success($stores);
    }

    public function show($id){
    	$store = Store::with('order')->find($id);

        if ($store) {
            return $this->success($store);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Retirada em loja inválida');
        }
    }

    public function store(Request $request){
    	$orderId = $request->input('order_id', null);
        $code = $request->input('order_code', null);

        if (empty($orderId) || empty($code)) {
            return $this->error(self::VALIDATION_ERROR, 'Parametros inválidos');
        }

        $order = Order::find($orderId);
        if (!$order) {
            return $this->error(self::INVALID_RESOURCE, 'Pedido inválido');
        }

        Store::where('order_id', $order->id)->delete();
        $store = new Store();
    	$store->fill($request->all());
    	$store->save();

        $order->changeStatus(Order::IN_STORE);
        return $this->success();
    }

    public function update(Request $request, $id){
    	$status = $request->input('store_status', null);
    	$order = Order::find($id);

    	if(!$order){
    		return $this->error(self::INVALID_RESOURCE, 'Pedido inválido');
    	}

    	if(!($status === Order::RETIRED || $status === Order::CANCELED) || !$status){
    		return $this->error(self::INVALID_RESOURCE, 'Status de Retirada Inválido');
    	}

    	$order->changeStatus($status);
    	return $this->success();
    }

    public function destroy($id){}

}