FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip libzip-dev unzip git curl

# Install PHP extensions for MySQL, ZIP, and image processing
RUN docker-php-ext-install pdo_mysql zip gd

# Set application directory
WORKDIR /var/www
COPY . .

# Install Composer dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-scripts --no-autoloader

# Set proper permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Configure PHP-FPM service
EXPOSE 9000
CMD ["php-fpm"]