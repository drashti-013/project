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
            $table->id('product_id');
            $table->string('product_name');
            $table->decimal('price',8, 2);
            $table->unsignedBigInteger('catgory_id');
            $table->foreign('catgory_id')->references('category_id')->on('categorys')->onDelete('cascade')->onUpdate('cascade');
            $table->string('unit');
            $table->string('short_description');
            $table->longText('long_description');
            // $table->json('images');
            $table->boolean('status');
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
