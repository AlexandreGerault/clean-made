FROM php:fpm

WORKDIR /usr/src/apps/website

RUN apt-get update && \
apt-get install -y \
libzip-dev

RUN pecl install apcu xdebug

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu xdebug

RUN mkdir /.config
RUN mkdir /.config/psysh
RUN chown -R 1000:1000 /.config
RUN chmod -R 774 /.config

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN mkdir /.composer && chown -R 1000:1000 /.composer && chmod -R 774 /.composer

RUN PATH=$PATH:/usr/src/apps/website/vendor/bin:bin
