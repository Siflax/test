<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventorySettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventorySettings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('shop_id')->unsigned();
            $table->integer('globalLimit')->index();
            $table->boolean('isTrackedGlobally')->default(True);
            $table->string('frequency');

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
        Schema::drop('inventorySettings');
    }

}
