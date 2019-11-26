<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('order_id')->nullable($value = true);
            $table->char('name', 100)->nullable($value = true);
            $table->string('phone')->nullable($value = true);
            $table->string('address')->nullable($value = true);
            $table->char('email',100)->nullable($value = true);
            $table->text('message')->nullable($value = true);  
            $table->text('product')->nullable($value = true);
            $table->text('order_status')->nullable($value = true);
            $table->text('total_amount')->nullable($value = true);
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
        Schema::dropIfExists('tbl_order');
    }
}
