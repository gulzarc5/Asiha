<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_category', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('slug',256)->nullable();
            $table->string('image',256);
            $table->char('status',1)->default(1)->comment("1= Enable,2 = Disable");
            $table->char('is_sub_category',1)->default(1)->comment("1= No,2 = Yes");
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
        Schema::dropIfExists('sub_category');
    }
}
