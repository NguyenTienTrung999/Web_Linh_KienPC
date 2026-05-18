#!/bin/sh

# Tự động xóa toàn bộ bảng cũ và nạp lại hệ thống database sạch sẽ
echo "Hệ thống đang làm sạch và nạp lại database từ đầu..."
php artisan migrate:fresh --force

# Nếu dự án của bạn có dữ liệu mẫu (Seeder), hãy dùng dòng dưới đây thay cho dòng trên:
# php artisan migrate:fresh --seed --force

# Khởi động máy chủ Web
echo "Đang khởi động máy chủ Web..."
exec /start.sh