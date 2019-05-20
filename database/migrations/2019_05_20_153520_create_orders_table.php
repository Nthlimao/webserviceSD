<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('client_id')->unsigned();

            $table->float('total_price', 40, 2);
            $table->float('products_price', 40, 2);
            $table->float('delivery_price', 10, 2);

            $table->enum('delivery_method', ['DELIVERYMAN', 'STORE']);
            $table->enum('payment_method', ['APP', 'MONEY', 'CREDITCARD', 'DEBITCARD']);
            $table->integer('delivery_address')->nullable();

            $table->enum('status', [
                'OPEN',
                'IN_SEPARATION',
                'IN_ROUTE',
                'IN_STORE',
                'CANCELED',
                'DELIVERED',
                'RETIRED'
            ])->nullable()->default('OPEN');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
