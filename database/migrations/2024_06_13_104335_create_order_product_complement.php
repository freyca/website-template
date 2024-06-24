<?php

use App\Models\ProductComplement;
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
        Schema::create('order_product_complement', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('order_id')->constrained();
            $table->foreignIdFor(ProductComplement::class)->constrained();
            $table->float('unit_price');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product_complement');
    }
};
