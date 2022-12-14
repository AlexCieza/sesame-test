FROM php:7.4-fpm-alpine3.13

COPY ./docker/php/wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apk add --no-cache \
        git \
        bash \
        libzip-dev \
        openssl-dev \
        rabbitmq-c-dev && \
    docker-php-ext-install -j$(nproc) \
        zip \
        pdo \
        pdo_mysql && \
    apk add --no-cache --virtual .phpize_deps $PHPIZE_DEPS && \
    pecl install xdebug-2.9.2 && \
    docker-php-ext-enable xdebug && \
    pecl install \
        amqp-1.9.4 && \
    docker-php-ext-enable \
        amqp && \
    rm -rf /usr/share/php7 && \
    rm -rf /tmp/pear && \
    apk del .phpize_deps && \
    mkdir /var/app

RUN curl https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

COPY ./docker/php/config/php.ini /usr/local/etc/php/php.ini
ENV PATH /var/app/bin:/var/app/vendor/bin:$PATH
WORKDIR /var/app
