FROM php:fpm

RUN apt update && apt upgrade -y
RUN apt install libcurl4-openssl-dev libgmp-dev git unzip -y
RUN docker-php-ext-install pdo pdo_mysql gmp curl bcmath
RUN pecl install xdebug && docker-php-ext-enable xdebug