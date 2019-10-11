FROM php:7.2-fpm-alpine

MAINTAINER "saifoelloh@gmail.com"

RUN docker-php-ext-install pdo pdo_mysql
