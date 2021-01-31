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

            $table->uuid('extern_id');

            $table->foreignId('code_id');
            $table->foreignId('group_id');
            $table->foreignId('mountedon_id');
            $table->foreignId('supplier_id');

            $table->integer('current');
            $table->string('delivery_from')->nullable();
            $table->text('description');
            $table->text('details');
            $table->string('info');
            $table->decimal('kw');
            $table->string('customer_price_code');
            $table->string('oem_number');
            $table->string('power');
            $table->decimal('price');
            $table->string('features');
            $table->string('pulley_details');
            $table->string('pulley_type');
            $table->string('rotation');
            $table->integer('stock');
            $table->string('teeth');
            $table->string('voltage');

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
