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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('status')->default(1); //giá trị mặc định là 1
            $table->enum('role', ['Normally', 'Partner'])->default('Normally');
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('image_user')->nullable();
            $table->rememberToken();
            $table->string('verification_code')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('staffs', function (Blueprint $table) {
            $table->id('staff_id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('status');
            $table->enum('role', ['staff', 'admin'])->default('staff');
            $table->text('address')->nullable();
            $table->string('avata')->nullable();
            $table->rememberToken();
            $table->string('verification_code')->nullable();
            $table->timestamps();
        });
        // nhớ thêm cho bảng staff  liên kết tới đây
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            // $table->foreignId('staff_id')->nullable()->constrained('staffs')->onDelete('cascade');
            $table->foreignId('staff_id')->nullable()->constrained('staffs', 'staff_id')->onDelete('cascade'); // Đảm bảo staff_id tồn tại trong bảng staffs
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->foreignId('staff_id')->constrained('staffs', 'staff_id');
            $table->string('name_category')->unique(); // Chỉ định chiều dài 255
            $table->string('image_category');
            $table->text('description');
            $table->integer('status');
            $table->timestamps();
        });
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id('sub_category_id');
            $table->foreignId('category_id')->constrained('categories', 'category_id');
            $table->string('name_sub_category')->unique();
            $table->string('image_sub_category');
            $table->text('description');
            $table->integer('status');
            $table->timestamps();
        });
        Schema::create('subcategory_attributes', function (Blueprint $table) {
            $table->id('subcategory_attribute_id');
            $table->foreignId('sub_category_id')->constrained('sub_categories', 'sub_category_id');
            $table->text('attributes_name');
        });
        Schema::create('sale_news', function (Blueprint $table) {
            $table->id('sale_new_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('sub_category_id')->constrained('sub_categories', 'sub_category_id');
            $table->text('title')->nullable();
            $table->decimal('price', 10, 0)->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
            // $table->

        });
        Schema::create('channels', function (Blueprint $table) {
            $table->id('channel_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->string('name_channel')->nullable();
            $table->string('image_channel');
            $table->text('address');
            $table->string('phone_number');
            $table->integer('status')->nullable();
            $table->timestamps();
        });
        Schema::create('user_followed', function (Blueprint $table) {
            $table->id('user_followed_id');
            $table->foreignid('user_id')->constrained('users', 'user_id');
            $table->foreignid('channel_id')->constrained('channels', 'channel_id');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('blogs', function (Blueprint $table) {
            $table->id('blog_id');
            $table->foreignid('staff_id')->constrained('staffs', 'staff_id');
            $table->string('title');
            $table->string('content')->nullable();
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('payment_method', function (Blueprint $table) {
            $table->id('payment_method_id');
            $table->foreignID('staff_id')->constrained('staffs', 'staff_id');
            $table->text('name_method');
            $table->string('content');
        });
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('detail_order_id');
            $table->foreignId('channel_id')->constrained('channels', 'channel_id');
            $table->foreignId('order_id')->constrained('orders', 'order_id');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->decimal('value');
            $table->integer('stock');
        });
        Schema::create('carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->foreignId('channel_id')->constrained('channels', 'channel_id');
            $table->integer('stock');
            $table->decimal('value_product', 10, 2);
        });
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
        Schema::create('photo_gallery', function (Blueprint $table) {
            $table->id('photo_gallery_id');
            $table->foreignId('product_id')->nullable()->constrained('products', 'product_id');
            $table->foreignId('sale_new_id')->nullable()->constrained('sale_news', 'sale_new_id');
            $table->string('image_name');
            $table->timestamps();
        });
        Schema::create('likes', function (Blueprint $table) {
            $table->id('like_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('product_id')->nullable()->constrained('products', 'product_id');
            $table->foreignId('sale_new_id')->nullable()->constrained('sale_news', 'sale_new_id');
            $table->integer('status');
            $table->timestamps();
        });
        Schema::create('evaluation', function (Blueprint $table) {
            $table->id('avalute_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('channel_id')->constrained('channels', 'channel_id');
            $table->string('content');
            $table->timestamp('created_at');
        });
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
