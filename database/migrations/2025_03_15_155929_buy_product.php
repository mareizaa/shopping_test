<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buy_product', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->integer('amount');

            $table->unsignedBigInteger('buy_id');
            $table->foreign('buy_id')->on('buys')->references('id');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buy_product');
    }
};
