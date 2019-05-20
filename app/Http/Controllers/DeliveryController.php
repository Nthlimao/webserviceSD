<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(){
    	$deliveries = Delivery::all();
        
        return $this->success($deliveries);
    }

    public function show($id){
        $delivery = Delivery::with(['order', 'user'])->find($id);

        if ($delivery) {
            return $this->success($delivery);
        } else {
            return $this->error(self::INVALID_RESOURCE, 'Endereço inválido');
        }
    }

    public function store(Request $request){
        $deliverymanId = $request->input('deliveryman_id', null);
    	$orderId = $request->input('order_id', null);
        $code = $request->input('tracking_code', null);    	

    	if (empty($orderId) || (empty($deliverymanId) && empty($code))) {
            return $this->error(self::VALIDATION_ERROR, 'Parametros inválidos');
        }

        $order = Order::find($orderId);
        if (!$order) {
            return $this->error(self::INVALID_RESOURCE, 'Pedido inválido');
        }

        Delivery::where('order_id', $order->id)->delete();

        if ($deliverymanId) {
            $deliveryman = User::find($deliverymanId);

            if (!$deliveryman) {
                return $this->error(self::INVALID_RESOURCE, 'Entregador inválido');
            }

            $delivery = new Delivery();
    		$delivery->fill($request->all());
    		$delivery->save();

            $order->changeStatus(Order::IN_ROUTE);
            return $this->success();
        }
    }

    public function update(Request $request, $id){
    	$status = $request->input('delivery_status', null);
    	$order = Order::find($id);

    	if(!$order){
    		return $this->error(self::INVALID_RESOURCE, 'Pedido inválido');
    	}

    	if(!($status === Order::DELIVERED || $status === Order::CANCELED) || !$status){
    		return $this->error(self::INVALID_RESOURCE, 'Status de Entrega Inválido');
    	}

    	$order->changeStatus($status);
    	return $this->success();
    }

    public function destroy($id){}
}
