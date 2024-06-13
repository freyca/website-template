<?php

use App\Enums\OrderStatus;
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

        $order_status = [];

        foreach (OrderStatus::cases() as $case) {
            array_push($order_status, $case->value);
        }

        Schema::create('orders', function (Blueprint $table) use ($payment_methods, $order_status) {
            $table->id();
            $table->float('purchase_cost');
            $table->enum('payment_method', $payment_methods)->default(PaymentMethods::bank_transfer->name);
            $table->enum('status', $order_status)->default(OrderStatus::PENDING_PAYMENT->value);
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
