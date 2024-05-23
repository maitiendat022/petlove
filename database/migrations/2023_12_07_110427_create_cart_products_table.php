<?php

use App\Models\Carts;
use App\Models\ProductDetail;
use App\Models\Products;
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
        Schema::create('cart_products', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->timestamps();

            $table->foreignIdFor(Carts::class,'cart_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Products::class,'product_id')->constrained();
            $table->foreignIdFor(ProductDetail::class,'detail_id')->constrained('product_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_products');
    }
};
