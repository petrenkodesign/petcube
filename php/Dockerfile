FROM php:7.4-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global user.email "petrenkodesign@gmail.com" \ 
    && git config --global user.name "Olexa Petrenko"

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN composer create-project --no-interaction symfony/website-skeleton ./ ^4.4.0

RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/

RUN composer install

#create database
RUN php bin/console doctrine:database:create 
#entry migration
RUN php bin/console doctrine:schema:update --force
#add admin user for dashboard
RUN php bin/console app:create-admin --username=admin --email=admin@admin --password=admin --no-interaction