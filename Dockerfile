FROM php:8.2.4-fpm

WORKDIR /var/www

RUN docker-php-ext-install pdo_mysql

COPY . /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN composer install --no-scripts --no-autoloader --no-progress --prefer-dist

RUN composer dump-autoload --optimize && \
    composer run-script post-autoload-dump && \
    php artisan optimize && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache 

CMD ["php-fpm"]

EXPOSE 9000
