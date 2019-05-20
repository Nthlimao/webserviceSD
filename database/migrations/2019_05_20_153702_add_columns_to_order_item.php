<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOrderItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('color_id')->unsigned()->nullable();
            $table->integer('size_id')->unsigned()->nullable();

            $table->float('price', 20, 2);

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('color_id')->references('id')->on('product_colors');
            $table->foreign('size_id')->references('id')->on('product_sizes');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('color_id');
            $table->dropColumn('size_id');
            $table->dropColumn('price');
        });
    }
}
