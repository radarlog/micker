FROM php:7.4-fpm-alpine3.11 as development

ENV WORK_DIR /app

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /tmp
COPY --from=composer:latest /usr/bin/composer /usr/bin

ENV XDEBUG_VERSION 2.9.2
ENV PHP_XDEBUG_ENABLE 1

RUN set -e \
	&& cd /tmp \
    #
    # Install dependencies
    && apk --no-cache add --update $PHPIZE_DEPS \
    #
    # Compile Xdebug extension
    && yes | pecl install xdebug-$XDEBUG_VERSION \
    #
    # Clean up
    && apk del --purge $PHPIZE_DEPS \
    && rm -rf /tmp/* /var/cache/apk/* /var/lib/apt/lists/*

COPY xdebug.ini $PHP_INI_DIR/conf.d/

COPY . $WORK_DIR

WORKDIR $WORK_DIR

EXPOSE 9000

CMD ["php-fpm", "--nodaemonize"]
