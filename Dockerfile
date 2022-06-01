FROM php:8.0-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY .env /home
EXPOSE 80