FROM php:8.0-fpm-alpine

WORKDIR /var/www/laravel-testing

COPY . /var/www/laravel-testing

# Get packages that we need in container
RUN apt-get update -q -y \
    && apt-get install -q -y --no-install-recommends \
        ca-certificates \
        curl \
        acl \
        sudo \
        unzip \
        git \

RUN docker-php-ext-install pdo pdo_mysql