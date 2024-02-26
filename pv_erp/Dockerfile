FROM php:7.4-fpm

RUN apt-get update && apt-get install \
&& docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN docker-php-ext-install pdo pdo_mysql sockets
# RUN curl -sS https://getcomposer.org/installer​ | php -- \--install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . .



