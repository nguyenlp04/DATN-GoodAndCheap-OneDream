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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('payment_method_id')->constrained('payment_method', 'payment_method_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->text('name_receiver');
            $table->decimal('price', 10, 2);
            $table->string('phone_number');
            $table->text('address');
            $table->enum('status', ['canceled', 'completed', 'in_progress', 'pending', 'shipped'])->default('pending');
            $table->timestamps();
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
