ARG PHP_FPM_IMAGE=php:8.0-fpm-alpine3.15
ARG COMPOSER_IMAGE=composer:2.1

# development dependencies
FROM $COMPOSER_IMAGE AS composer

FROM $PHP_FPM_IMAGE as development

ENV WORK_DIR /app

COPY --from=composer /usr/bin/composer /usr/bin

ENV PCOV_VERSION 1.0.10
ENV XDEBUG_VERSION 3.1.1

RUN set -e \
	&& cd /tmp \
    #
    # Install dependencies
    && apk --no-cache add --update $PHPIZE_DEPS \
    #
    # Add PCOV and Xdebug extensions
    && pecl bundle -d /usr/src/php/ext pcov-$PCOV_VERSION \
    && pecl bundle -d /usr/src/php/ext xdebug-$XDEBUG_VERSION \
    #
    # Configure and install extensions
    && export CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
    && docker-php-ext-install \
        opcache \
        pcov \
        xdebug \
    #
    # Clean up
    && apk del --purge $PHPIZE_DEPS \
    && rm -rf /tmp/* /var/cache/apk/* /usr/src/*

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
