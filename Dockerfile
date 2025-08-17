FROM php:8.2-apache

# Cài extension cần thiết
RUN docker-php-ext-install pdo pdo_mysql

# Copy toàn bộ source vào container
COPY . /var/www/html

# Set quyền
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Apache document root => trỏ vào public
WORKDIR /var/www/html
RUN sed -i 's|/var/www/html|/var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Enable rewrite (Laravel cần mod_rewrite)
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
