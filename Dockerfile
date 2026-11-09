
FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev libonig-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip intl gd \
    && rm -rf /var/lib/apt/lists/*

# PHP upload configuration
RUN printf "upload_max_filesize=20M\npost_max_size=100M\nmemory_limit=256M\nmax_execution_time=120\nmax_input_time=120\n" > /usr/local/etc/php/conf.d/uploads.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-scripts

COPY . .

RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
    storage/app/public/cars

EXPOSE 8000

CMD ["sh", "-lc", "composer install --no-interaction --prefer-dist && php artisan serve --host=0.0.0.0 --port=8000"]
