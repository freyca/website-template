<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\User;
use App\Models\Address;
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

        foreach (PaymentMethod::cases() as $case) {
            array_push($payment_methods, $case->value);
        }

        $order_status = [];

        foreach (OrderStatus::cases() as $case) {
            array_push($order_status, $case->value);
        }

        Schema::create('orders', function (Blueprint $table) use ($payment_methods, $order_status) {
            $table->ulid('id')->primary();
            $table->integer('purchase_cost');
            $table->enum('payment_method', $payment_methods);
            $table->enum('status', $order_status);
            $table->foreignIdFor(User::class)->constrained()->nullable();
            $table->foreignIdFor(Address::class)->constrained()->nullable();
            $table->json('payment_gateway_response')->nullable();
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
