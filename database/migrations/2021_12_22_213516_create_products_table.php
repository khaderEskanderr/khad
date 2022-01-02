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

            $table->id();
            $table->double('price_ofer');
            $table->string('name');
            $table->string('image_url');
            $table->date('price_offer');
            $table->double('prices')->default(0);
            $table->integer('quantity')->default(1);
            $table->text('cate_id');
            $table->text('user_id');
            $table->text('description');
            $table->string('creat_up');
            $table->string('update_up');
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
