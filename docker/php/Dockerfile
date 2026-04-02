FROM php:8.3-fpm

# ---------- パッケージ ----------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    nano \
    libzip-dev \
    default-mysql-client \
    gosu \
    && docker-php-ext-install pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# ---------- PHP設定 ----------
COPY php.ini /usr/local/etc/php/

# ---------- php-fpm ログ設定 ----------
RUN sed -i 's|error_log = /proc/self/fd/2|error_log = /tmp/php-fpm-error.log|g' /usr/local/etc/php-fpm.d/docker.conf \
    && sed -i 's|access.log = /proc/self/fd/2|access.log = /tmp/php-fpm-access.log|g' /usr/local/etc/php-fpm.d/docker.conf \
    && touch /tmp/php-fpm-error.log /tmp/php-fpm-access.log \
    && chmod 777 /tmp/php-fpm-error.log /tmp/php-fpm-access.log

# ---------- Composer ----------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ---------- Composer HOME ----------
ENV COMPOSER_HOME=/tmp/composer
RUN mkdir -p /tmp/composer && chmod -R 777 /tmp/composer

# ---------- entrypoint ----------
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
