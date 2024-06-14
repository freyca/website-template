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
            $table->id();
            $table->string('name')->unique();
            $table->float('price');
            $table->float('price_with_discount')->nullable();
            $table->boolean('published')->default(false)->index();
            $table->unsignedInteger('stock');
            $table->string('slogan');
            $table->string('meta_description');
            $table->text('short_description');
            $table->text('description');
            $table->string('main_image');
            $table->json('images');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
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
