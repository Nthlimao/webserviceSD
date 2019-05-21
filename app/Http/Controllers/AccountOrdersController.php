<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AccountOrdersController extends Controller
{
    public function index(){
    	$user = $this->user();
    	$orders = Order::with(['items', 'delivery', 'store'])->where('client_id', $user->id)->get();
    	return $this->success($orders);
    }

    public function show($id){
    	$user = $this->user();
        $order = Order::with(['items', 'delivery', 'store'])->where('client_id', $user->id)->find($id);

        if ($order) {
            return $this->success($order);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Pedido inválido.');
        }
    }
}
