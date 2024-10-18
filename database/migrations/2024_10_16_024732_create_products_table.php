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
            $table->foreignId('staff_id')->constrained('staffs', 'staff_id');
            $table->foreignId('sub_category_id')->constrained('sub_categories', 'sub_category_id');
            $table->foreignId('channel_id')->constrained('channels', 'channel_id');
            $table->text('name_product');
            $table->decimal('price', 10, 2);
            $table->text('data');
            $table->text('description');
            $table->integer('status');
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
