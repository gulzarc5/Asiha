<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThirdCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('third_category', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->unsignedBigInteger('sub_category_id');
            $table->string('name');
            $table->string('slug',256)->nullable();
            $table->string('image',256);
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
        Schema::dropIfExists('third_category');
    }
}
