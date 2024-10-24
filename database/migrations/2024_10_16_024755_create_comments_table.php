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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->foreignId('parent_id')->nullable()->constrained('comments', 'comment_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('staff_id')->nullable()->constrained('staffs', 'staff_id');
            $table->foreignId('product_id')->nullable()->constrained('products', 'product_id');
            $table->foreignId('sale_new_id')->nullable()->constrained('sale_news', 'sale_new_id');
            $table->text('content');
            $table->integer('status');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
