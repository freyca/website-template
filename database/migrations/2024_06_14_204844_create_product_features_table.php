<?php

use App\Enums\ProductFeatureFamily;
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
        $family = [];

        foreach (ProductFeatureFamily::cases() as $case) {
            array_push($family, $case->value);
        }

        Schema::create('product_features', function (Blueprint $table) use ($family) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('family', $family);
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_features');
    }
};
