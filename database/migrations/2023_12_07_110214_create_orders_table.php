<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reciver_name');
            $table->string('reciver_phone');
            $table->string('reciver_address');
            $table->double('total');
            $table->text('note')->nullable();
            $table->string('payment');
            $table->string('status')->default('unconfirmed');
            $table->timestamps();

            $table->foreignIdFor(User::class,'user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
