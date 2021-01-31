<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FbForeignKeysProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fb_products', function (Blueprint $table) {
            $table->foreign('code_id')->references('id')->on('fb_product_codes');
            $table->foreign('group_id')->references('id')->on('fb_product_groups');
            $table->foreign('mountedon_id')->references('id')->on('fb_product_mount_ons');
            $table->foreign('supplier_id')->references('id')->on('fb_product_suppliers');
        });

        Schema::table('fb_product_images', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('fb_products');
        });

        Schema::table('fb_product_replacements', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('fb_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fb_product_replacements', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::table('fb_product_images', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::table('fb_products', function (Blueprint $table) {
            $table->dropForeign(['code_id']);
            $table->dropForeign(['group_id']);
            $table->dropForeign(['mountedon_id']);
            $table->dropForeign(['supplier_id']);
        });
    }
}
