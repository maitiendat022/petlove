<?php

use App\Models\Products;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
    Schema::create('product_detail', function (Blueprint $table) {
        $table->id();
        $table->string('size');
        $table->string('color');
        $table->integer('quantity')->nullable();
        $table->double('price')->nullable();
        $table->timestamps();

        $table->foreignIdFor(Products::class,'product_id')->constrained()->cascadeOnDelete();
    });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::dropIfExists('product_detail');
}
};
