#!/bin/sh

# 1. Tự động chạy migrate tạo database khi deploy
echo "Hệ thống đang kiểm tra và nạp database (Migration)..."
php artisan migrate --force

# 2. Chạy lệnh gốc của image để kích hoạt Nginx và PHP-FPM
echo "Đang khởi động máy chủ Web..."
exec /start.sh