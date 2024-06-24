<?php

use App\Models\User;
use App\Models\UserMetadata;
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
        Schema::create('user_metadata', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('address');
            $table->string('city');
            $table->integer('postal_code');
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignIdFor(UserMetadata::class)->constrained('user_metadata');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_metadata');

        Schema::table('orders', function ($table) {
            $table->dropColumn('user_metadata_id');
        });
    }
};
