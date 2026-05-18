#!/bin/sh

# Đổi từ migrate:fresh sang migrate tiêu chuẩn để giữ lại dữ liệu cũ
echo "Hệ thống đang kiểm tra và nạp cấu trúc database mới..."
php artisan migrate --force

echo "Đang khởi động máy chủ Web..."
exec /start.sh