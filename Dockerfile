FROM php:7.2-alpine

RUN apk --update add openssl curl git && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer &&\
    docker-php-ext-install pdo pdo_mysql mbstring

WORKDIR /app
COPY . /app

RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader && mv .env.production .env

RUN php artisan migrate --force

CMD php artisan serve --host=0.0.0.0 --port=80
