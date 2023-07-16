ARG PHP_FPM_IMAGE=php:8.2-fpm-alpine3.18
ARG COMPOSER_IMAGE=composer:2.5
ARG PHP_EXTENSION_INSTALLER=mlocati/php-extension-installer:2.1

# development dependencies
FROM $PHP_EXTENSION_INSTALLER AS php_extension_installer
FROM $COMPOSER_IMAGE AS composer

# development
FROM $PHP_FPM_IMAGE as development

ENV WORK_DIR /app

ARG PCOV_VERSION=1.0.11
ARG XDEBUG_VERSION=3.2.1

COPY --from=php_extension_installer /usr/bin/install-php-extensions /usr/local/bin/
COPY --from=composer /usr/bin/composer /usr/local/bin/

RUN set -e \
    #
    # Install dependencies
    && install-php-extensions opcache \
    && install-php-extensions pcntl \
    && install-php-extensions pcov-$PCOV_VERSION \
    && install-php-extensions xdebug-$XDEBUG_VERSION

ENV PHP_DISPLAY_ERRORS 1
ENV PHP_EXPOSE 0
ENV PHP_LOG_ERRORS 1
ENV PHP_MAX_EXECUTION_TIME 30
ENV PHP_MEMORY_LIMIT 128M

ENV PHP_OPCACHE_ENABLE 1
ENV PHP_OPCACHE_ENABLE_CLI 1
ENV PHP_OPCACHE_FAST_SHUTDOWN 1
ENV PHP_OPCACHE_INTERNED_STRINGS_BUFFER 8
ENV PHP_OPCACHE_MEMORY_CONSUMPTION 128
ENV PHP_OPCACHE_MAX_ACCELERATED_FILES 5000
ENV PHP_OPCACHE_REVALIDATE_FREQ 2
ENV PHP_OPCACHE_SAVE_COMMENTS 1

ENV XDEBUG_MODE off

COPY php.ini $PHP_INI_DIR/

WORKDIR $WORK_DIR

EXPOSE 9000

CMD ["php-fpm", "--nodaemonize"]
