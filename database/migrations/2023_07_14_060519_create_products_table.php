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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('price2', 8, 2)->nullable();
            $table->decimal('price3', 8, 2)->nullable();            
            $table->string('image')->nullable();
            $table->boolean('disponible')->nullable();
            $table->decimal('quantity')->nullable();
            $table->string('tag')->nullable();
            $table->string('tag2')->nullable();
            $table->string('tag3')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
