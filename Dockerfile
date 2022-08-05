FROM php:8-apache

RUN apt-get update
RUN apt-get install -y git
RUN apt-get install zip unzip

RUN a2enmod rewrite
RUN service apache2 restart
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY ./src /var/www
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

RUN composer install
RUN composer update

#CMD ["composer", "install"]
