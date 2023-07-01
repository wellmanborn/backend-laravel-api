FROM php:8.2-cli as php

RUN apt-get update
RUN apt install -y zip unzip wget zlib1g-dev libicu-dev

RUN docker-php-ext-install pdo_mysql intl opcache
COPY . /var/www/

WORKDIR /var/www/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 8000

RUN composer install
RUN php artisan cache:clear
RUN php artisan config:clear
RUN php artisan view:clear
RUN composer dump-autoload
RUN composer require --dev doctrine/dbal
RUN php artisan db:table
RUN php artisan migrate --seed

CMD php artisan serve --host=0.0.0.0 --port=8000
