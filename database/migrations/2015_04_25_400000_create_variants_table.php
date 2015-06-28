<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariantsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variants', function(Blueprint $table)
        {
            $table->bigInteger('id')->unique();
            $table->integer('shop_id')->unsigned();
            $table->bigInteger('product_id');
            $table->integer('inventory_limit');
            $table->boolean('track')->default(True);
            $table->timestamps();

            $table->foreign('shop_id')
                ->references('id')->on('shops')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('variants');
    }

}
