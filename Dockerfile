FROM php:cli-alpine

ENV COMPOSER_HOME /composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV PATH /opt/php-sic/bin:/composer/vendor/bin:$PATH

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /opt/php-sic
COPY . .

RUN rm -rf vendor \
    && echo "Installing composer dependencies..." \
    && composer install -q

VOLUME ["/app"]
WORKDIR /app