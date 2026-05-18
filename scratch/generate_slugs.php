<?php

// Trỏ về thư mục gốc của dự án
$basePath = dirname(__DIR__);

require $basePath . '/vendor/autoload.php';
$app = require_once $basePath . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Support\Str;

$products = Product::all();
$count = 0;

foreach ($products as $p) {
    $p->slug = Str::slug($p->name);
    if ($p->save()) {
        $count++;
    }
}

echo "Đã cập nhật xong {$count} sản phẩm!";
