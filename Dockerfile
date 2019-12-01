FROM phusion/baseimage

MAINTAINER Artem Golovin<artem@xtc.vc>

ENV BUILD_DEPS \
        wget \
        build-essential \
        re2c \
        net-tools \
        git \
        unzip

ENV NGINX_DEPS \
        nginx

ENV PHP70_DEPS \
        php7.0 \
        php7.0-cli \
        php7.0-common \
        php7.0-mysql \
        php7.0-fpm \
        php7.0-dev \
        php7.0-zip \
        php-xdebug \
        php-mcrypt \
        php7.0-soap \
        php7.0-mbstring \
        php7.0-intl \
        php7.0-xml \
        php7.0-curl \
        php7.0-gd \
        php7.0-json

ENV NODEJS_DEPS \
        nodejs \
        npm

# ...put your own build instructions here...
RUN set -xe && \
        apt-get update && apt-get install -y --force-yes --no-install-recommends --no-install-suggests \
            $BUILD_DEPS \
            $NGINX_DEPS \
            $PHP70_DEPS \
            $NODEJS_DEPS \
            supervisor \
            openssl \
        && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# nginx
COPY ./build/default /etc/nginx/conf.d/vhost.conf
RUN rm -Rf /etc/nginx/sites-enabled/default

# php
RUN /etc/init.d/php7.0-fpm start

# PHP composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

WORKDIR /var/www
COPY composer.json .
COPY composer.lock .

# composer install
RUN composer config -g repositories.packagist composer http://packagist.phpcomposer.com
RUN composer install --no-scripts --no-autoloader
COPY . .
RUN composer dump-autoload --optimize

# supervisor
COPY ./supervisor/*.conf /etc/supervisor/conf.d/

RUN usermod -u 1000 www-data
RUN cp -n .env.prod .env
RUN rm -Rf node_modules

RUN chown -R www-data:www-data .
RUN chmod 777 /var/www/public/images/cards

# start laravel schedule
RUN /bin/bash -c 'crontab -l | { cat; echo "* * * * * php /var/www/artisan schedule:run >> /dev/null 2>&1"; } | crontab -'

EXPOSE 80

# Use baseimage-docker's init system.
CMD ["/usr/bin/supervisord"]
