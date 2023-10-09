<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Rename the 'product_id' column to 'product_colors_sizes_id'
            $table->unsignedBigInteger('product_colors_sizes_id')->nullable();
            $table->foreign('product_colors_sizes_id')->references('id')->on('product_colors_sizes');
        
            // Add new columns
            $table->string('size');
            $table->string('color');

            $table->decimal('subtotal', 8, 2)->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Reverse the changes made in the 'up' method
            $table->renameColumn('product_colors_sizes_id', 'product_id');
            $table->dropForeign(['product_colors_sizes_id']);
            $table->dropColumn('product_colors_sizes_id');
            $table->dropColumn(['size', 'color']);
        });
    }
};
