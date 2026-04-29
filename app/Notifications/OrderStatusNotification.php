<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($order, $status = null)
    {
        $this->order = $order;
        $this->status = $status ?? $order->status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'status' => $this->status,
            'message' => $this->getMessage(),
        ];
    }

    /**
     * Generate localized message based on status.
     */
    protected function getMessage()
    {
        if ($this->status === 'pending') {
            return "Chúc mừng! Bạn đã đặt hàng thành công đơn hàng #" . $this->order->id;
        }
        
        $statusLabels = [
            'processing' => 'đang được xử lý',
            'shipping' => 'đang được giao',
            'completed' => 'đã hoàn thành',
            'cancelled' => 'đã bị hủy',
        ];

        $label = $statusLabels[$this->status] ?? $this->status;
        return "Đơn hàng #" . $this->order->id . " của bạn " . $label;
    }
}
