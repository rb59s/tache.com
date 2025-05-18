FROM php:8.2-apache
RUN apt -y update && apt -y upgrade
RUN apt install -y libfreetype6-dev \
&& docker-php-ext-configure gd --with-freetype=/usr/include/freetype2/ \
&& docker-php-ext-install pdo_mysql gd
RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
EXPOSE 80

