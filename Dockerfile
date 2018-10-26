FROM php:cli-alpine

RUN (curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer) \
    && export COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /opt/php-sic
COPY . .

RUN rm -rf vendor \
    && echo "Installing composer dependencies..." \
    && composer install -q