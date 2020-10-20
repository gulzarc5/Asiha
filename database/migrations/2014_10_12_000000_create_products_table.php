<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',256);
            $table->string('slug',256)->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('sub_category_id')->nullable();
            $table->bigInteger('last_category_id')->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->string('main_image',256)->nullable();
            $table->string('size_chart')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->double('min_price', 10, 2)->default(0);
            $table->double('mrp', 10, 2)->default(0);
            $table->char('status',1)->default(1)->comment("1= Not Popular,2 = Popular");
            $table->char('status',1)->default(1)->comment("1= Enable,2 = Disable");
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
        Schema::dropIfExists('products');
    }
}
