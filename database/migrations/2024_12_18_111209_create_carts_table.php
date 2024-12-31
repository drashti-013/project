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
    Schema::create('carts', function (Blueprint $table) {
        $table->id('cart_id');
        $table->unsignedBigInteger('pro_id');
        $table->unsignedBigInteger('client_id'); // Ensure 'client_id' matches exactly
        $table->boolean('is_watchlist');
        
        // Define foreign keys correctly
        $table->foreign('pro_id')->references('product_id')->on('products')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->foreign('client_id')->references('client_id')->on('clients') // No extra space here
            ->onDelete('cascade')
            ->onUpdate('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
