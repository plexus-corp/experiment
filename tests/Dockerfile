# Start multi-stage build with composer image
ARG COMPOSER_IMAGE_TAG=2
ARG BASE_IMAGE_TAG=7.2-apache
FROM composer:${COMPOSER_IMAGE_TAG} AS composer-init-stage


# Get dependencies using Composer
FROM php:${BASE_IMAGE_TAG} AS composer-install-stage

ARG COMPOSER_INSTALL_ARGS="--no-dev"
WORKDIR /var/www/html/experiment
COPY . ./
COPY --from=composer-init-stage /usr/bin/composer /usr/bin/composer
RUN apt-get update \
  && DEBIAN_FRONTEND=noninteractive apt-get install -y \
    libicu-dev \
    unzip \
  && docker-php-ext-install -j$(nproc) \
    intl

RUN composer install ${COMPOSER_INSTALL_ARGS}

RUN composer require cakephp/app:~4.1 cakephp/debug_kit phpunit/phpunit:^8.5

RUN cp -R vendor/cakephp/app/bin .
RUN cp -R vendor/cakephp/app/config .
RUN cp config/app_local.example.php config/app_local.php

RUN bin/cake

RUN vendor/bin/phpunit


# Build final image
# ARG BASE_IMAGE_TAG=7.2-apache
FROM php:${BASE_IMAGE_TAG} AS app-test-stage

LABEL maintainer="mike.tallroth@plexus.com"

ENV APP_ROOT_DIR=/var/www/html/experiment

WORKDIR ${APP_ROOT_DIR}

COPY --from=composer-install-stage ${APP_ROOT_DIR} ./

