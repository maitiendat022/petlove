<?php

use App\Models\Servieces;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->time('time');
            $table->date('date');
            $table->string('book_name');
            $table->string('book_phone');
            $table->string('pet_name');
            $table->string('pet_age');
            $table->string('pet_specie');
            $table->string('pet_weight');
            $table->text('note')->nullable();
            $table->string('status')->default('unconfirmed');
            $table->timestamps();

            $table->foreignIdFor(User::class,'user_id')->constrained();
            $table->foreignIdFor(Servieces::class,'serviece_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
