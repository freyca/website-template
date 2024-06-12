<?php

use App\Enums\PaymentMethods;
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
        $payment_methods = [];

        foreach (PaymentMethods::cases() as $case) {
            array_push($payment_methods, $case->name);
        }

        Schema::create('orders', function (Blueprint $table) use ($payment_methods) {
            $table->id();
            $table->float('purchase_cost');
            $table->enum('payment_method', $payment_methods)->default(PaymentMethods::bank_transfer->name);
            $table->boolean('payed');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
