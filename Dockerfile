FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    wget \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install intl opcache pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

USER www-data

COPY --chown=www-data:www-data . .

RUN composer install --optimize-autoloader

EXPOSE 9000

CMD ["php-fpm"]
