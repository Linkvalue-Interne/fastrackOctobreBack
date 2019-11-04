FROM php:7.3-fpm-alpine
COPY ./ /var/www/html
WORKDIR /var/www/html
RUN docker-php-ext-install \
      pdo \
      pdo_mysql \
    && apk add --update \
      --repository http://dl-3.alpinelinux.org/alpine/edge/community/ \
      --repository http://dl-3.alpinelinux.org/alpine/edge/main/ \
      git \
      openssh-client \
      composer \
      fontconfig \
      libxrender \
      libxext \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
    && pecl install xdebug \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/* $HOME/.cache \
    && composer install --no-scripts \
    && chown -R 82:82 /var/www/html