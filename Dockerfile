FROM php:8.0-apache
# Instalar la extensión mysqli
RUN docker-php-ext-install mysqli
# COPY . /var/www/html
RUN echo iniciado