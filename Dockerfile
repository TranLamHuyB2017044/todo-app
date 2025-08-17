# Base image PHP + Apache
FROM php:8.2-apache

# Cài các extension PHP cần thiết
RUN docker-php-ext-install pdo pdo_mysql

# Copy toàn bộ source vào container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Enable Apache mod_rewrite (Laravel cần rewrite route)
RUN a2enmod rewrite

# Chỉnh quyền cho storage và bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose cổng 80
EXPOSE 80

# Laravel chạy bằng Apache
CMD ["apache2-foreground"]
