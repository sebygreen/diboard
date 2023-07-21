FROM php:8-fpm

RUN apt update && apt upgrade -y
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
RUN apt install libcurl4-openssl-dev libgmp-dev git unzip -y
RUN docker-php-ext-install pdo pdo_mysql gmp curl bcmath

WORKDIR /var/www/html
COPY ../../site/composer.json .
USER www-data:www-data
RUN composer update && composer install
