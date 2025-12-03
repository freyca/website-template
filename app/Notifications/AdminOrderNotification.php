<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminOrderNotification extends Notification
{
    use Queueable;

    public function __construct(private Order $order) {}

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $order = $this->order->load('orderProducts.orderable', 'user', 'shippingAddress', 'billingAddress');

        return (new MailMessage)
            ->subject(__('New Order Created').' - #'.$order->id)
            ->line(__('A new order has been created'))
            ->line(__('Order ID').': '.$order->id)
            ->line(__('Customer').': '.$order->user->name.' '.$order->user->surname)
            ->line(__('Customer Email').': '.$order->user->email)
            ->line(__('Total Amount').': €'.number_format($order->purchase_cost / 100, 2))
            ->line(__('Payment Method').': '.$order->payment_method->value)
            ->line(__('Products'.':'))
            ->markdown('emails.admin-order', [
                'order' => $order,
                'products' => $order->orderProducts,
            ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
        ];
    }
}
