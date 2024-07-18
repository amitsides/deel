FROM php:8.2-fpm
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y nano procps net-tools
RUN docker-php-ext-install pdo_mysql