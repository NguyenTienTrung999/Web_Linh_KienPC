<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SePayWebhookController extends Controller
{
    /**
     * Handle SePay Webhook.
     *
     * SePay sends a POST request with JSON body.
     * Content example mapping to Order: "DH00000025" -> ID 25
     */
    public function handle(Request $request)
    {
        Log::info('SePay Webhook Received', $request->all());

        // 1. Authenticate Request
        $token = $request->header('Authorization');
        $expectedToken = 'Apikey ' . env('SEPAY_TOKEN');

        if ($token !== $expectedToken) {
            Log::warning('SePay Webhook: Unauthorized access attempt.');
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // 2. Parse Order ID from description/content
        // Example content: "DH00000025" or "Thanh toan don hang DH25"
        $content = $request->input('content');
        $prefix = env('SEPAY_PREFIX', 'DH');

        // Find the prefix followed by numbers
        if (preg_match('/' . $prefix . '(\d+)/', $content, $matches)) {
            $orderId = $matches[1];
            $order = Order::find($orderId);

            if ($order) {
                // 3. Verify Amount
                $receivedAmount = (float) $request->input('transferAmount');

                if ($receivedAmount >= $order->total_price) {
                    $order->update([
                        'status' => Order::STATUS_PROCESSING,
                        'note' => $order->note . "\n[SePay] Đã thanh toán đủ " . number_format($receivedAmount) . 'đ lúc ' . $request->input('transactionDate'),
                    ]);

                    // Send Notification to user about payment confirmation
                    if ($order->user) {
                        $order->user->notify(new \App\Notifications\OrderStatusNotification($order, Order::STATUS_PROCESSING));
                    }

                    Log::info("SePay Webhook: Order #{$orderId} updated to processing.");
                    return response()->json(['success' => true]);
                } else {
                    // Cảnh báo thanh toán thiếu
                    $order->update([
                        'note' => $order->note . "\n[CẢNH BÁO] Nhận được " . number_format($receivedAmount) . 'đ nhưng chưa đủ tổng đơn (' . number_format($order->total_price) . 'đ)',
                    ]);
                    
                    Log::warning("SePay Webhook: Partial payment for Order #{$orderId}. Received: {$receivedAmount}, Expected: {$order->total_price}");
                    
                    // Vẫn return success 200 để SePay không gửi lại webhook
                    return response()->json(['success' => true, 'message' => 'Ghi nhận thanh toán thiếu']);
                }
            }

            Log::error("SePay Webhook: Order #{$orderId} not found.");
        } else {
            Log::warning("SePay Webhook: Could not find Order ID parsing content: '{$content}'");
        }

        // Always return success to SePay to stop retries if the format was at least received
        return response()->json(['success' => false, 'message' => 'Order not found or invalid content'], 200);
    }
}
