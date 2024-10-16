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
        Schema::create('conversation', function (Blueprint $table) {
            $table->id('conversation_id');
            $table->unsignedBigInteger('sender_id'); // ID của người gửi
            $table->unsignedBigInteger('receiver_id'); // ID của người nhận
            $table->enum('sender_type', ['user', 'staff']); // 'staff' hoặc 'user'
            $table->enum('receiver_type', ['user', 'staff']); // 'staff' hoặc 'user'
            $table->timestamps(); // Tự động tạo created_at và updated_at

            // Ràng buộc khóa ngoại cho người gửi
            $table->foreign('sender_id', 'fk_conversation_sender_id_staff') // Chỉ định tên
                  ->references('staff_id')->on('staffs')->onDelete('cascade');
            $table->foreign('sender_id', 'fk_conversation_sender_id_user') // Chỉ định tên
                  ->references('user_id')->on('users')->onDelete('cascade');

            // Ràng buộc khóa ngoại cho người nhận
            $table->foreign('receiver_id', 'fk_conversation_receiver_id_staff') // Chỉ định tên
                  ->references('staff_id')->on('staffs')->onDelete('cascade');
            $table->foreign('receiver_id', 'fk_conversation_receiver_id_user') // Chỉ định tên
                  ->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation');
    }
};
