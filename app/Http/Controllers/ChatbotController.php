<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\Category;

class ChatbotController extends Controller
{
    /**
     * Handle the chatbot conversation.
     */
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $apiKey = config('services.gemini.key');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'reply' => 'Hệ thống AI chưa được cấu hình API Key.'
            ]);
        }

        try {
            // Lấy toàn bộ danh mục để AI biết cửa hàng có những gì
            $categories = Category::withCount('products')->get();
            $categoryList = $categories->map(function($cat) {
                return "- {$cat->name} (" . ($cat->products_count > 0 ? "Đang có hàng" : "Sắp về hàng") . ")";
            })->implode("\n");

            // Lấy 30 sản phẩm có giá tốt nhất và CÒN HÀNG
            $products = Product::where('is_active', true)
                ->where('stock_quantity', '>', 0)
                ->orderByRaw('COALESCE(sale_price, price) ASC')
                ->limit(30)
                ->get(['name', 'slug', 'price', 'sale_price']);
            
            $productInfo = $products->map(function($p) {
                $finalPrice = number_format($p->sale_price ?: $p->price, 0, ',', '.') . 'đ';
                return "Sản phẩm: {$p->name} | Giá: {$finalPrice} | Đường dẫn: /products/{$p->slug}";
            })->implode("\n");

            $systemPrompt = "Bạn là trợ lý ảo TechFlow AI. 
            Cửa hàng hiện có các danh mục sau:
            {$categoryList}

            Danh sách sản phẩm CÓ GIÁ TỐT NHẤT và đường dẫn:
            {$productInfo}

            QUY TẮC TƯ VẤN:
            1. Khi khách hỏi về sản phẩm, hãy lọc từ danh sách trên và CHỈ ĐƯA RA TỐI ĐA 10 SẢN PHẨM có giá tốt nhất (rẻ nhất).
            2. Nếu thấy sản phẩm, hãy dẫn link theo định dạng [Tên sản phẩm](Đường dẫn) và kèm theo giá tiền để khách dễ tham khảo.
            3. Nếu khách hỏi về một danh mục có trong hệ thống nhưng không có sản phẩm nào trong danh sách giá tốt này, hãy báo là hàng đang về.

            QUY TẮC TRÌNH BÀY:
            - Sử dụng danh sách gạch đầu dòng, mỗi sản phẩm một dòng.";

            $response = Http::withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => "System Instruction: {$systemPrompt}\n\nUser Question: {$userMessage}"]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 1024,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Tôi đang suy nghĩ, bạn có thể hỏi lại được không?';
                
                return response()->json([
                    'success' => true,
                    'reply' => $reply
                ]);
            }

            return response()->json([
                'success' => false,
                'reply' => 'Lỗi từ AI: ' . ($response->json()['error']['message'] ?? 'Không xác định')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'reply' => 'Lỗi kết nối: ' . $e->getMessage()
            ]);
        }
    }
}
