<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
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
            return 'Chúc mừng! Bạn đã đặt hàng thành công đơn hàng #' . $this->order->id . '. Vui lòng hoàn tất thanh toán.';
        }

        $statusLabels = [
            'processing' => 'đã được xác nhận và đang chờ xử lý',
            'packing' => 'đang được chuẩn bị hàng',
            'shipping' => 'đang được giao đến bạn',
            'completed' => 'đã được giao thành công',
            'cancelled' => 'đã bị hủy',
            'failed' => 'gặp sự cố khi thanh toán hoặc giao hàng',
            'refunded' => 'đã được hoàn tiền/trả hàng',
        ];

        $label = $statusLabels[$this->status] ?? $this->status;
        return 'Đơn hàng #' . $this->order->id . ' của bạn ' . $label;
    }
}
