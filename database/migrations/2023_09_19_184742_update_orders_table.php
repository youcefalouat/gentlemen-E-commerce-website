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
            $table->string('nom');
            $table->string('prenom');
            $table->unsignedBigInteger('wilaya_id');
            $table->unsignedBigInteger('commune_id');
            $table->string('telephone');

            // Modify existing columns
            $table->string('status')->default('pending')->change();
            $table->decimal('total_amount', 8, 2)->default(0)->change();
            $table->string('payment_status')->default('unpaid')->change();

            // Define foreign key constraints if necessary
            $table->foreign('wilaya_id')->references('id')->on('wilayas');
            $table->foreign('commune_id')->references('id')->on('communes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Reverse the changes made in the "up" method
            $table->dropColumn(['nom', 'prenom', 'wilaya_id', 'commune_id', 'telephone']);
            $table->string('status')->change();
            $table->decimal('total_amount', 8, 2)->change();
            $table->string('payment_status')->change();
            $table->dropForeign(['wilaya_id']);
            $table->dropForeign(['commune_id']);
        });
    }
    
};
