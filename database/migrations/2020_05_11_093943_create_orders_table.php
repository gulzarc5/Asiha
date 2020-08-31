<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('total_quantity');
            $table->double('total_discount',10,2)->default(0);
            $table->double('total_price',10,2)->default(0)->comment('Total Price After Discount');
            $table->string('payment_request_id',256)->nullable();
            $table->char('payment_status',1)->default(1)->comment('1 = unpaid,2 = paid, 3 = COD');
            $table->char('order_status',1)->default(1)->comment('1 = new order,2 = dispatched, 3 = delivered, 4 = cancelled');
            $table->char('order_status_updated_by',1)->default(1)->comment('1 = user,2 = Admin');
            $table->timestamps();
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
