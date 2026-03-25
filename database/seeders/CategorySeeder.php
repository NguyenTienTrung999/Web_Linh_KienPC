<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Chuột', 'description' => 'Các loại chuột máy tính gaming và văn phòng'],
            ['name' => 'Bàn phím', 'description' => 'Bàn phím cơ, bàn phím membrane cho gaming và văn phòng'],
            ['name' => 'Tai nghe', 'description' => 'Tai nghe gaming, tai nghe không dây, tai nghe có mic'],
            ['name' => 'Loa', 'description' => 'Loa vi tính, loa bluetooth, loa soundbar'],
            ['name' => 'Webcam', 'description' => 'Webcam HD, webcam cho họp trực tuyến và livestream'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
