FROM richarvey/nginx-php-fpm:latest

# Copy toàn bộ code vào container
COPY . /var/www/html

# Cấu hình môi trường Webroot cho Nginx trỏ vào thư mục public của Laravel
ENV WEBROOT /var/www/html/public
ENV APP_ENV production
ENV APP_DEBUG false

# Cho phép Composer chạy với quyền root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Cài đặt các thư viện PHP qua Composer
RUN composer install --no-dev --optimize-autoloader

# Cấp quyền ghi log và cache cho Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Cấp quyền thực thi cho file script deploy
RUN chmod +x /var/www/html/deploy.sh

EXPOSE 80

# Chỉ định Container chạy file script này khi khởi động
CMD ["/var/www/html/deploy.sh"]