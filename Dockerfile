FROM php:8-apache

RUN apt-get update

RUN a2enmod rewrite
RUN service apache2 restart
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY ./src /var/www
