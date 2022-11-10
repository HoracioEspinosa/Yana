FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache zip libzip-dev bash
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql

RUN apk add libzip-dev