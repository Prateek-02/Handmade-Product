<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Status Updated')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('The status of your order has been updated.')
            ->line('Product: ' . $this->order->product->name)
            ->line('Current Status: ' . ucfirst($this->order->status))
            ->line('Thank you for shopping with us!')
            ->salutation('Warm regards, Handmade Marketplace Team');
    }
}
