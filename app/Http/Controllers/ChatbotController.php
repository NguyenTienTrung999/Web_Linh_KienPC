<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    /**
     * Handle the chatbot conversation.
     */
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $apiKey = config('services.gemini.key');

        if (! $apiKey) {
            return response()->json([
                'success' => false,
                'reply' => 'Hệ thống AI chưa được cấu hình API Key.',
            ]);
        }

        try {
            // Lấy toàn bộ danh mục để AI biết cửa hàng có những gì
            $categories = Category::withCount('products')->get();
            $categoryList = $categories->map(function ($cat) {
                return "- {$cat->name} (" . ($cat->products_count > 0 ? 'Đang có hàng' : 'Sắp về hàng') . ')';
            })->implode("\n");

            // Lấy 30 sản phẩm có giá tốt nhất và CÒN HÀNG
            $products = Product::where('is_active', true)
                ->where('stock_quantity', '>', 0)
                ->orderByRaw('COALESCE(sale_price, price) ASC')
                ->limit(30)
                ->get(['name', 'slug', 'price', 'sale_price']);

            $productInfo = $products->map(function ($p) {
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

            $response = Http::withoutVerifying()
                ->timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key={$apiKey}", [
                    'system_instruction' => [
                        'parts' => [
                            ['text' => $systemPrompt],
                        ],
                    ],
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => $userMessage],
                            ],
                        ],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.8,
                        'maxOutputTokens' => 2048,
                        'topP' => 0.95,
                    ],
                    'safetySettings' => [
                        ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_NONE'],
                        ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_NONE'],
                        ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_NONE'],
                        ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_NONE'],
                    ],
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $finishReason = $data['candidates'][0]['finishReason'] ?? '';
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Tôi đang suy nghĩ, bạn có thể hỏi lại được không?';

                if ($finishReason === 'SAFETY') {
                    $reply .= "\n\n(Lưu ý: Một phần câu trả lời bị ẩn do chính sách an toàn của AI)";
                }

                return response()->json([
                    'success' => true,
                    'reply' => $reply,
                ]);
            }

            \Log::error('AI API Error: ' . $response->body());

            // Fallback to simpler prompt if system_instruction fails or other 400 error
            if ($response->status() === 400 || $response->status() === 429) {
                return $this->fallbackChat($userMessage, $systemPrompt, $apiKey);
            }

            return response()->json([
                'success' => false,
                'reply' => 'Lỗi từ AI (' . $response->status() . '): ' . ($response->json()['error']['message'] ?? 'Không xác định'),
            ]);
        } catch (\Exception $e) {
            \Log::error('Chatbot Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'reply' => 'Lỗi kết nối: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Fallback for older models or API errors.
     */
    private function fallbackChat($userMessage, $systemPrompt, $apiKey)
    {
        try {
            $response = Http::withoutVerifying()->timeout(30)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "Bạn là trợ lý ảo TechFlow AI. Dựa trên dữ liệu sau:\n{$systemPrompt}\n\nCâu hỏi khách hàng: " . $userMessage],
                        ],
                    ],
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Tôi đang bận, vui lòng thử lại.';
                return response()->json(['success' => true, 'reply' => $reply]);
            }
        } catch (\Exception $e) {
            \Log::error('Fallback Chatbot Exception: ' . $e->getMessage());
        }

        return response()->json(['success' => false, 'reply' => 'Hệ thống AI hiện tại đang bảo trì hoặc hết hạn mức. Vui lòng thử lại sau.']);
    }
}
