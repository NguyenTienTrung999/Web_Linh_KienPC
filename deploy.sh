#!/bin/sh
echo "Hệ thống đang kiểm tra và nạp cấu trúc database mới..."
php artisan migrate --force

# THÊM DÒNG NÀY: Để kích hoạt hiển thị hình ảnh sản phẩm
echo "Đang liên kết thư mục lưu trữ hình ảnh..."
php artisan storage:link || true

echo "Đang khởi động máy chủ Web..."
exec /start.sh