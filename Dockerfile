FROM php:8.2-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev zip unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install opcache pdo pdo_mysql

WORKDIR /app
COPY . /app

RUN composer install

RUN apt-get update
RUN apt-get -y install curl gnupg
RUN curl -sL https://deb.nodesource.com/setup_20.x  | bash -
RUN apt-get -y install nodejs
RUN npm install

COPY docker/symfony /usr/local/bin/symfony

EXPOSE 8080
CMD symfony local:server:start --port=8080
