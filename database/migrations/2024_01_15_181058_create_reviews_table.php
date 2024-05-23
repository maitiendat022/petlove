<?php

use App\Models\OrderProduct;
use App\Models\Products;
use App\Models\User;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('rating')->nullable();
            $table->text('comment')->nullable();
            $table->string('image')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();

            $table->foreignIdFor(User::class,'user_id')->constrained();
            $table->foreignIdFor(Products::class,'product_id')->constrained();
            $table->foreignIdFor(OrderProduct::class,'orderProduct_id')->constrained('order_products');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
