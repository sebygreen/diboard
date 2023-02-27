FROM php:8-fpm

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
RUN apt-get update && apt-get upgrade -y

RUN apt-get install libgmp-dev git unzip -y
RUN docker-php-ext-install pdo pdo_mysql gmp bcmath

WORKDIR /var/www/html
COPY ../../site/composer.json .
USER www-data:www-data
RUN composer update && composer install
