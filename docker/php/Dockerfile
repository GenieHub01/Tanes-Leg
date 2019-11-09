FROM php:7.2-fpm

# Install modules
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libicu-dev \
        wget \
        git \
            --no-install-recommends


RUN docker-php-ext-install  zip intl mbstring pdo pdo_mysql exif \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd
    #&& redis-server
#RUN docker-php-ext-install pdo_mysql pdo  pdo_pgsql

RUN pecl install -o -f xdebug-2.6.1  \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

COPY ./install-composer.sh /
COPY ./php.ini /usr/local/etc/php/
COPY ./www.conf /usr/local/etc/php/

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh /install-composer.sh \
    && rm /install-composer.sh

RUN usermod -u 1000 www-data

VOLUME /root/.composer
WORKDIR /app

#RUN cd /app && composer update
#chown -R nginx:nginx /app/vendor
EXPOSE 9000
CMD ["php-fpm"]
