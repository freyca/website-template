<?php

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminOrderNotification;
use App\Notifications\OrderConfirmationNotification;
use Illuminate\Support\Facades\Notification;

describe('Order Notifications', function () {
    beforeEach(function () {
        Notification::fake();
        // Create an admin user for tests that need it
        User::factory()->create(['role' => 'admin']);
    });

    describe('OrderCreated Event', function () {
        it('dispatches with order instance', function () {
            $user = User::factory()->create();
            $order = Order::factory()->for($user)->create();

            expect($order)->toBeInstanceOf(Order::class);
        });

        it('triggers listeners when order is created', function () {
            $user = User::factory()->create();
            Order::factory()->for($user)->create();

            Notification::assertSentTo($user, OrderConfirmationNotification::class);
        });
    });

    describe('SendOrderConfirmationToUser Listener', function () {
        it('sends confirmation notification to user', function () {
            $user = User::factory()->create();
            Order::factory()->for($user)->create();

            Notification::assertSentTo($user, OrderConfirmationNotification::class);
        });

        it('notification is sent exactly once', function () {
            $user = User::factory()->create();
            Order::factory()->for($user)->create();

            expect(Notification::sent($user, OrderConfirmationNotification::class))->toHaveCount(1);
        });
    });

    describe('SendOrderNotificationToAdmin Listener', function () {
        it('sends admin notification when order is created', function () {
            $admin = User::factory()->create(['role' => 'admin']);
            $user = User::factory()->create();
            Order::factory()->for($user)->create();

            Notification::assertSentTo($admin, AdminOrderNotification::class);
        });

        it('throws exception if no admin exists', function () {
            // Delete any existing admins
            User::where('role', 'admin')->delete();

            $user = User::factory()->create();
            // Don't create admin - this should cause an exception when order is created

            expect(function () use ($user) {
                Order::factory()->for($user)->create();
            })->toThrow(RuntimeException::class);
        });

        it('sends to admin exactly once', function () {
            $admin = User::factory()->create(['role' => 'admin']);
            $user = User::factory()->create();
            Order::factory()->for($user)->create();

            expect(Notification::sent($admin, AdminOrderNotification::class))->toHaveCount(1);
        });
    });

    describe('OrderConfirmationNotification', function () {
        it('sends via mail channel', function () {
            $user = User::factory()->create();
            Order::factory()->for($user)->create();

            Notification::assertSentTo(
                $user,
                OrderConfirmationNotification::class,
                function ($notification) use ($user) {
                    return in_array('mail', $notification->via($user));
                }
            );
        });

        it('notification contains order data', function () {
            $user = User::factory()->create();
            $order = Order::factory()->for($user)->create();
            
            // Create a ProductSparePart with required dependencies
            $disassembly = \App\Models\Disassembly::factory()->create();
            $sparePart = \App\Models\ProductSparePart::factory()->for($disassembly)->create();
            
            // Add product to order
            $order->orderProducts()->create([
                'orderable_id' => $sparePart->id,
                'orderable_type' => \App\Models\ProductSparePart::class,
                'quantity' => 2,
                'unit_price' => 5000,
                'assembly_price' => 0,
            ]);

            Notification::assertSentTo(
                $user,
                OrderConfirmationNotification::class
            );

            // Verify the notification would render with order data
            $order->load('orderProducts.orderable', 'user', 'shippingAddress', 'billingAddress');
            $notification = new OrderConfirmationNotification($order);
            $mail = $notification->toMail($user);
            $rendered = $mail->render();

            // Check for essential email content
            expect(str_contains($rendered, (string)$order->id))->toBeTrue();
            expect(str_contains($rendered, $user->name))->toBeTrue();
            expect(str_contains($rendered, $order->shippingAddress->address))->toBeTrue();
            
            // Check for product details
            $product = $order->orderProducts->first();
            expect($product)->not->toBeNull();
            expect(str_contains($rendered, $product->orderable->name))->toBeTrue();
            expect(str_contains($rendered, (string)$product->quantity))->toBeTrue();
        });
    });
    describe('AdminOrderNotification', function () {
        it('sends via mail channel', function () {
            $admin = User::factory()->create(['role' => 'admin']);
            $user = User::factory()->create();
            Order::factory()->for($user)->create();

            Notification::assertSentTo(
                $admin,
                AdminOrderNotification::class,
                function ($notification) use ($admin) {
                    return in_array('mail', $notification->via($admin));
                }
            );
        });

        it('notification is sent to admin', function () {
            $admin = User::factory()->create(['role' => 'admin']);
            $user = User::factory()->create();
            $order = Order::factory()->for($user)->create();
            
            // Create a ProductSparePart with required dependencies
            $disassembly = \App\Models\Disassembly::factory()->create();
            $sparePart = \App\Models\ProductSparePart::factory()->for($disassembly)->create();
            
            // Add product to order
            $order->orderProducts()->create([
                'orderable_id' => $sparePart->id,
                'orderable_type' => \App\Models\ProductSparePart::class,
                'quantity' => 3,
                'unit_price' => 7500,
                'assembly_price' => 0,
            ]);

            Notification::assertSentTo(
                $admin,
                AdminOrderNotification::class
            );

            // Verify the notification would render with order data
            $order->load('orderProducts.orderable', 'user', 'shippingAddress', 'billingAddress');
            $notification = new AdminOrderNotification($order);
            $mail = $notification->toMail($user);
            $rendered = $mail->render();

            // Check for essential email content
            expect(str_contains($rendered, (string)$order->id))->toBeTrue();
            expect(str_contains($rendered, $user->name))->toBeTrue();
            expect(str_contains($rendered, $order->shippingAddress->address))->toBeTrue();
            
            // Check for product details
            $product = $order->orderProducts->first();
            expect($product)->not->toBeNull();
            expect(str_contains($rendered, $product->orderable->name))->toBeTrue();
            expect(str_contains($rendered, (string)$product->quantity))->toBeTrue();
        });
    });

    describe('Order with Addresses', function () {
        it('sends notification with shipping address', function () {
            $user = User::factory()->create();
            $order = Order::factory()->for($user)->create();

            expect($order->shippingAddress)->not->toBeNull();
        });

        it('handles billing address different from shipping', function () {
            $user = User::factory()->create();
            $shippingAddress = Address::factory()->for($user)->create();
            $billingAddress = Address::factory()->for($user)->create();
            $order = Order::factory()
                ->for($user)
                ->for($shippingAddress, 'shippingAddress')
                ->for($billingAddress, 'billingAddress')
                ->create();

            expect($order->shippingAddress->id)->not->toBe($order->billingAddress->id);
        });
    });

    describe('Multiple Orders', function () {
        it('sends independent notifications for each order', function () {
            $user1 = User::factory()->create();
            $user2 = User::factory()->create();
            $admin = User::factory()->create(['role' => 'admin']);

            Order::factory()->for($user1)->create();
            Order::factory()->for($user2)->create();

            Notification::assertSentTo($user1, OrderConfirmationNotification::class);
            Notification::assertSentTo($user2, OrderConfirmationNotification::class);
            expect(Notification::sent($admin, AdminOrderNotification::class))->toHaveCount(2);
        });
    });
});
