<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoodsRateAndInsuranceRateToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedDecimal('item_rate',15,2)->default(0)->nullable()->comment('Item Rate')->after('grid_id');
            $table->unsignedDecimal('insurance_rate',15,2)->default(0)->nullable()->comment('Insurance Rate (per month)')->after('item_rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('item_rate');
            $table->dropColumn('insurance_rate');
        });
    }
}
