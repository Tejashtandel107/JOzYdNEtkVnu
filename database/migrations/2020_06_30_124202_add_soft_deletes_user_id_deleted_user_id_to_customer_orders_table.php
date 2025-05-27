<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesUserIdDeletedUserIdToCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->default(0)->nullable()->after('customer_id');
            $table->unsignedInteger('deleted_user_id')->default(0)->nullable()->after('order_by');
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('deleted_user_id');
            $table->dropSoftDeletes();
        });
    }
}
