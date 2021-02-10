FROM php:8

WORKDIR /sample

RUN apt-get -y update

RUN apt-get -y install git zip unzip curl

RUN apt-get -y install postgresql libpq-dev
RUN docker-php-ext-install pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

#RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
#RUN apt-get install -y nodejs
#RUN npm install -g npm@latest

RUN apt-get -y clean

COPY php.ini /usr/local/etc/php/php.ini

ENTRYPOINT ["/bin/bash", "docker/docker-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "80"]
