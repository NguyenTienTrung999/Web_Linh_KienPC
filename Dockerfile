FROM richarvey/nginx-php-fpm:latest

# Copy toàn bộ code vào container
COPY . /var/www/html

# Cấu hình môi trường Webroot cho Nginx trỏ vào thư mục public của Laravel
ENV WEBROOT /var/www/html/public
ENV APP_ENV production
ENV APP_DEBUG false

# Cài đặt các thư viện PHP qua Composer
RUN composer install --no-dev --allow-plugins --optimize-autoloader

# Cấp quyền ghi log và cache cho Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80