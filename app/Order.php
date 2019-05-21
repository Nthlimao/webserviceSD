<?php

namespace App;

use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;

    // STATUS
    const OPEN = 'OPEN';
    const IN_SEPARATION = 'IN_SEPARATION';    
    const IN_STORE = 'IN_STORE';
    const IN_ROUTE = 'IN_ROUTE';
    const DELIVERED = 'DELIVERED';
    const RETIRED = 'RETIRED';
    const CANCELED = 'CANCELED';


    protected $dates  = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
    	'client_id',
    	'total_price',
    	'products_price',
    	'delivery_price',
    	'delivery_method',
    	'payment_method',
    	'delivery_address',
    	'status'
    ];

    public const STORE = 'STORE';
    public const DELIVERYMAN = 'DELIVERYMAN';

    public function user() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function items() {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function delivery() {
        return $this->hasMany(Delivery::class, 'order_id');
    }

    public function store() {
        return $this->hasMany(Store::class, 'order_id');
    }

    public function changeStatus ($status) {
        $this->status = $status;
        $this->save();
    }
    
    public static function createOrder(User $client, $data) {
        $products = self::formatProductData($data['items']);
        self::checkStock($products);

        $costs = self::calculateOrderCosts($products, $data['delivery_method']);

        DB::beginTransaction();

        try {
            $order = new self();
            $order->fill($costs);

            $order->client_id = $client->id;
            $order->payment_method   = $data["payment_method"];
            $order->delivery_method  = $data["delivery_method"];
            $order->delivery_address = $data["delivery_address"];
            $order->save();

            $orderItems = array_map(function ($cur) use ($order) {
                return [
                    'order_id'   => $order->id, 
                    'product_id' => $cur["product"]["id"], 
                    'color_id'   => $cur["color"],
                    'size_id'    => $cur["size"],
                    'quantity'   => $cur["quantity"],
                    'price'      => $cur["product"]["price"]
                ];
            }, $products);

            OrderItem::insert($orderItems);

            foreach ($products as $product) {
                $newquantity = $product["product"]["quantity"] - $product["quantity"];

                $product = Product::find($product["product"]["id"]);
                $product->quantity = $newquantity;
                $product->save();
            }

            DB::commit();

            return $order;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    private static function formatProductData($items) {
        $hasColor = false;
        $hasSize = false;
        $output = [];

        foreach ($items as $item) {
            $product = Product::with(['colors', 'sizes'])->find($item['product_id']);
            $colors  = $product["colors"];
            $sizes   = $product["sizes"];

            if(isset($item["color_id"])){
                foreach($colors as $color){
                    if($color["id"] === $item["color_id"]){
                        $hasColor = true;
                        break;
                    }
                }
            } else {
                $hasColor = true;
            }

            if(isset($item["size_id"])){
                foreach($sizes as $size){
                    if($size["id"] === $item["size_id"]){
                        $hasSize = true;
                        break;
                    }
                }
            } else {
                $hasSize = true;
            }

            if (!$product || !$hasColor || !$hasSize) {
                throw new Exception('Produto inválido', 1);
            }

            $output[] = [
                'product' => $product,
                'color' => isset($item['color_id']) ? $item['color_id'] : null,
                'size'  => isset($item['size_id']) ? $item['size_id'] : null,
                'quantity' => $item['quantity']
            ];

            $hasColor = false;
            $hasSize = false;
        }

        return $output;
    }

    private static function checkStock($items){
        foreach ($items as $item) {
            $product = $item['product'];

            if($product) {
                $quantity = $item['quantity'];
                $hasStock = $product->quantity >= $quantity;

                if (!$hasStock) {
                    $name = $product->name;
                    throw new Exception("O produto \"{$name}\" excede a quantidade disponível no estoque.", 1);
                } 
            } else {
                throw new Exception('Produto inválido', 1);
            }
        }
    }

    private static function calculateOrderCosts($products, $deliveryMethod) {
        $cost = [
            'products_price'   => 0,
            'delivery_price'   => 0,
            'total_price'      => 0
        ];

        // DELIVERY PRICE
        if($deliveryMethod === self::DELIVERYMAN){
            $cost['delivery_price'] = 10;
            $cost['total_price'] += $cost['delivery_price'];
        } else if($deliveryMethod === self::STORE){
            $cost['delivery_price'] = 0;
            $cost['total_price'] += $cost['delivery_price'];
        } else {
            throw new Exception('Tipo de Entrega inválida', 1);
        }

        // PRODUCTS PRICE
        foreach ($products as $product) {
            $item = $product["product"];
            $price = $item["price"] * $product["quantity"];
            $cost['products_price'] += $price;
            $cost['total_price'] += $price;
        }

        return $cost;
    }
}