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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('id_notifications');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->string('title');
            $table->string('content');
            $table->string('image')->nullable();
            $table->enum('status', ['public', 'private'])->default('public');
            $table->enum('type', ['website', 'channel', 'user']);
            $table->datetime('delete_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
