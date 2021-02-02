<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FbCreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_products', function (Blueprint $table) {
            $table->id();

            $table->uuid('extern_id')->unique();

            $table->unsignedBigInteger('code_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('mountedon_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('replacement_for_id')->nullable();

            $table->integer('current')->nullable();
            $table->string('delivery_from')->nullable();
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->string('info')->nullable();
            $table->decimal('kw')->nullable();
            $table->string('customer_price_code')->nullable();
            $table->string('oem_number')->nullable();
            $table->string('power')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('price_old')->nullable();
            $table->string('features')->nullable();
            $table->string('pulley_details')->nullable();
            $table->string('pulley_type')->nullable();

            $table->string('rotation')->nullable();
            $table->integer('stock')->nullable();
            $table->string('teeth')->nullable();
            $table->string('voltage')->nullable();


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
        Schema::dropIfExists('fb_products');
    }
}
