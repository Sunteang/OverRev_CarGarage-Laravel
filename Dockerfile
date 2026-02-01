FROM php:8.2-apache
RUN apt-get update && apt-get install -y libpq-dev zip unzip git \
    && a2enmod rewrite \
    && docker-php-ext-install pdo_pgsql
COPY . /var/www/html
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
EXPOSE 80