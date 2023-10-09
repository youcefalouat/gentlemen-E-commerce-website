<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add new columns
            $table->string('telephone2');

            // Modify existing columns
            $table->string('status')->default('Commandé')->change();
            $table->string('payment_status')->default('e')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Reverse the changes made in the "up" method
            $table->dropColumn('telephone2');
            $table->string('status')->change();
            $table->string('payment_status')->change();
         
        });
    }
    
};
