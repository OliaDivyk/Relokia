FROM php:8.0.2-fpm

RUN apt-get update
RUN apt-get install -y wget git unzip
RUN pecl install xdebug-3.1.2
RUN docker-php-ext-enable xdebug

ADD ./php.ini /usr/local/etc/php/php.ini

RUN wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/bin --filename=composer --quiet

WORKDIR /var/www