<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index(){
    	$orders = Order::all();
        
        return $this->success($orders);
    }

    public function show($id){
    	$order = Order::with(['items', 'user'])->find($id);

        if ($order) {
            return $this->success($order);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Pedido Inválido');
        }
    }

    public function store(Request $request){
    	$order = Order::createOrder($this->user(), $request->all());

    	return $order;
    }

    public function update(Request $request, $id){
        $status = $request->input('delivery_status', null);
        $order = Order::find($id);

        if(!$order){
            return $this->error(self::INVALID_RESOURCE, 'Pedido inválido');
        }

        if(!$status){
            return $this->error(self::INVALID_RESOURCE, 'Status de Entrega Inválido');
        }

        $order->changeStatus($status);
        return $this->success($order);
    }

    public function destroy($id){}

}
