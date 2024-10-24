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
        Schema::create('subcategory_attributes', function (Blueprint $table) {
            $table->id('subcategory_attribute_id');
            $table->foreignId('sub_category_id')->constrained('sub_categories', 'sub_category_id');
            $table->text('attributes_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategory_attributes');
    }
};
