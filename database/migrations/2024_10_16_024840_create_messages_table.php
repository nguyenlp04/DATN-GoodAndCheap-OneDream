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
        Schema::create('messages', function (Blueprint $table) {
            $table->id('message_id');
            $table->foreignId('conversation_id')->constrained('conversation', 'conversation_id');
            $table->unsignedBigInteger('message_person');
            $table->text('content');
            $table->timestamps(); // Tự động tạo created_at và updated_at
            $table->enum('type', ['user', 'staff']);

            // Ràng buộc khóa ngoại cho người gửi
            $table->foreign('message_person', 'fk_message_person_staff') // Chỉ định tên
                  ->references('staff_id')->on('staffs')->onDelete('cascade');
            $table->foreign('message_person', 'fk_message_person_user') // Chỉ định tên
                  ->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
