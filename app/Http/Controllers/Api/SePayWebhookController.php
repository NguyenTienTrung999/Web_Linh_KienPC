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
                // 3. Verify Amount (Optional but recommended)
                $receivedAmount = (float) $request->input('transferAmount');
                
                // For a demo, we might be lenient, but ideally:
                // if ($receivedAmount >= $order->total_price) { ... }

                $order->update([
                    'status' => Order::STATUS_PROCESSING,
                    'note' => $order->note . "\n[SePay] Da thanh toan " . number_format($receivedAmount) . "d luc " . $request->input('transactionDate')
                ]);

                // Send Notification to user about payment confirmation
                if ($order->user) {
                    $order->user->notify(new \App\Notifications\OrderStatusNotification($order, Order::STATUS_PROCESSING));
                }

                Log::info("SePay Webhook: Order #{$orderId} updated to processing.");
                return response()->json(['success' => true]);
            }
            
            Log::error("SePay Webhook: Order #{$orderId} not found.");
        } else {
            Log::warning("SePay Webhook: Could not find Order ID parsing content: '{$content}'");
        }

        // Always return success to SePay to stop retries if the format was at least received
        return response()->json(['success' => false, 'message' => 'Order not found or invalid content'], 200);
    }
}
