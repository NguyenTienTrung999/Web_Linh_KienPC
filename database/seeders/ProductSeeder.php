<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Chuột (category_id = 1)
            ['category_id' => 1, 'name' => 'Chuột Logitech G502 Hero', 'price' => 1290000, 'description' => 'Chuột gaming Logitech G502 Hero với cảm biến HERO 25K, 11 nút lập trình', 'stock_quantity' => 50, 'image' => null],
            ['category_id' => 1, 'name' => 'Chuột Razer DeathAdder V3', 'price' => 1590000, 'description' => 'Chuột gaming Razer DeathAdder V3, cảm biến Focus Pro 30K, siêu nhẹ 59g', 'stock_quantity' => 35, 'image' => null],
            ['category_id' => 1, 'name' => 'Chuột không dây Logitech M331', 'price' => 390000, 'description' => 'Chuột không dây silent, phù hợp văn phòng, pin lên tới 24 tháng', 'stock_quantity' => 100, 'image' => null],

            // Bàn phím (category_id = 2)
            ['category_id' => 2, 'name' => 'Bàn phím cơ Akko 3068B Plus', 'price' => 1490000, 'description' => 'Bàn phím cơ 65%, switch Akko CS, kết nối Bluetooth/USB-C', 'stock_quantity' => 40, 'image' => null],
            ['category_id' => 2, 'name' => 'Bàn phím Corsair K70 RGB Pro', 'price' => 3290000, 'description' => 'Bàn phím cơ full-size, Cherry MX Red, đèn RGB per-key', 'stock_quantity' => 25, 'image' => null],
            ['category_id' => 2, 'name' => 'Bàn phím Logitech K380', 'price' => 790000, 'description' => 'Bàn phím không dây đa thiết bị, Bluetooth, thiết kế gọn nhẹ', 'stock_quantity' => 80, 'image' => null],

            // Tai nghe (category_id = 3)
            ['category_id' => 3, 'name' => 'Tai nghe HyperX Cloud III', 'price' => 2190000, 'description' => 'Tai nghe gaming 7.1, driver 53mm, mic có thể tháo rời', 'stock_quantity' => 30, 'image' => null],
            ['category_id' => 3, 'name' => 'Tai nghe Sony WH-1000XM5', 'price' => 7490000, 'description' => 'Tai nghe chống ồn chủ động, âm thanh Hi-Res, pin 30 giờ', 'stock_quantity' => 15, 'image' => null],
            ['category_id' => 3, 'name' => 'Tai nghe Razer Kraken V3', 'price' => 1890000, 'description' => 'Tai nghe gaming THX Spatial Audio, driver TriForce 50mm', 'stock_quantity' => 45, 'image' => null],

            // Loa (category_id = 4)
            ['category_id' => 4, 'name' => 'Loa Edifier R1280T', 'price' => 1690000, 'description' => 'Loa bookshelf 2.0, công suất 42W, kết nối RCA', 'stock_quantity' => 20, 'image' => null],
            ['category_id' => 4, 'name' => 'Loa JBL Charge 5', 'price' => 3490000, 'description' => 'Loa bluetooth di động, chống nước IP67, pin 20 giờ', 'stock_quantity' => 25, 'image' => null],
            ['category_id' => 4, 'name' => 'Loa Soundbar Samsung HW-B450', 'price' => 2790000, 'description' => 'Soundbar 2.1 kênh, công suất 300W, có subwoofer không dây', 'stock_quantity' => 18, 'image' => null],

            // Webcam (category_id = 5)
            ['category_id' => 5, 'name' => 'Webcam Logitech C920 HD Pro', 'price' => 1890000, 'description' => 'Webcam Full HD 1080p, mic kép stereo, tự động lấy nét', 'stock_quantity' => 40, 'image' => null],
            ['category_id' => 5, 'name' => 'Webcam Logitech Brio 4K', 'price' => 4290000, 'description' => 'Webcam 4K Ultra HD, HDR, Windows Hello, zoom 5x', 'stock_quantity' => 12, 'image' => null],
            ['category_id' => 5, 'name' => 'Webcam Razer Kiyo Pro', 'price' => 2990000, 'description' => 'Webcam Full HD 1080p/60fps, cảm biến ánh sáng thích ứng', 'stock_quantity' => 22, 'image' => null],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
