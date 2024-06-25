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

RUN if [ "$APP_ENV" = "dev" ] || [ "$APP_ENV" = "test" ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug; \
    fi

RUN if [ "$APP_ENV" = "dev" ] || [ "$APP_ENV" = "test" ]; then \
    echo "memory_limit=-1" > /usr/local/etc/php/conf.d/memory-limit.ini; \
    fi


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY  . .

RUN composer install --no-plugins --no-scripts --optimize-autoloader

EXPOSE 9000

CMD ["php-fpm"]
