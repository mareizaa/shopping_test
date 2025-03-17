<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buys', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->integer('amount');

            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->on('payments')->references('id');

            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->on('states')->references('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buys');
    }
};
