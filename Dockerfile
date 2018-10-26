FROM php:cli-alpine

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 

WORKDIR /opt/php-sic

COPY . .

RUN composer install
