<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('size',256)->nullable();
            $table->unsignedBigInteger('quantity')->default(1);
            $table->double('price',10,2)->default(0);
            $table->double('mrp',10,2)->default(0);
            $table->double('discount',10,2)->default(0)->comment('Discount in Percentage');
            $table->char('order_status',1)->default(1)->comment('1 = new order,2 = Packed,3 = shipped,4 = delivered,5=cancel,6 = Return request,7 = returned');
            $table->char('refund_request',1)->default(1)->comment('1 = No,2 = Yes,3 = Refunded');
            $table->double('refund_amount',10,2)->default(0);
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
        Schema::dropIfExists('order_details');
    }
}
