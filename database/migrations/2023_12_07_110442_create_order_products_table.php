<?php

use App\Models\Orders;
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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->double('total');
            $table->timestamps();

            $table->foreignIdFor(Orders::class,'order_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Products::class,'product_id')->constrained();
            $table->foreignIdFor(ProductDetail::class,'detail_id')->constrained('product_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
