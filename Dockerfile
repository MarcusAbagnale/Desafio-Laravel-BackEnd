FROM php:8.2.4-fpm


RUN docker-php-ext-install pdo_mysql

COPY . /var/www

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000
