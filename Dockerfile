FROM debian:wheezy

MAINTAINER lcefr <laurent.cetinsoy@gmail.com>

RUN apt-get update && apt-get install -y curl php5-cli php5-pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


COPY . /var/www
WORKDIR /var/www
RUN composer update
