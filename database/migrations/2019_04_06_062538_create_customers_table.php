<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('customer_id');
            $table->string('companyname')->nullable();
            $table->text('address')->nullable();
            $table->string('gstnumber')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('phone',50)->nullable();
            $table->string('photo',100)->nullable();
            $table->boolean('isactive')->default(true)->comment('1=Active,0=Inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
