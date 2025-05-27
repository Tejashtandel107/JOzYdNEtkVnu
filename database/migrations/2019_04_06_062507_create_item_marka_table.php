<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemMarkaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marka', function (Blueprint $table) {
            $table->increments('marka_id');
            $table->unsignedInteger('item_id')->default(0);
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();

            
            $table->index('item_id','item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marka');
    }
}
