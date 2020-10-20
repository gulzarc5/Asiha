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
            $table->unsignedBigInteger('shipping_address_id');
            $table->double('discount',10,2)->default(0);
            $table->double('amount',10,2)->default(0);
            $table->double('shipping_charge',10,2)->default(0);
            $table->double('total_amount',10,2)->default(0)->comment('Total Price After Discount');
            $table->string('payment_request_id',256)->nullable();
            $table->string('payment_id',256)->nullable();
            $table->char('payment_type',1)->default(1)->comment('1 = COD, 2 = Online');
            $table->char('payment_status',1)->default(1)->comment('	1 = cod,2 = paid,3 = failed');
            $table->char('order_status',1)->default(1)->comment('1 = new order,2 = Packed,3 = shipped,4 = delivered,5=cancel,6 = Return request,7 = returned');
            $table->char('refund_request',1)->default(1)->comment('1 = No,2 = Yes,3 = Refunded');
            $table->char('order_status_updated_by',1)->default(2)->comment('1 = user,2 = Admin');
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
