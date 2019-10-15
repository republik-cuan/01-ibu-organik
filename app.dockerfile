FROM php:7.2-fpm

MAINTAINER "saifoelloh@gmail.com"

RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip pdo pdo_mysql
