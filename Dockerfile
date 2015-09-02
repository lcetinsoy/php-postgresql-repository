FROM debian:wheezy

MAINTAINER lcefr <laurent.cetinsoy@gmail.com>

RUN apt-get update && apt-get install -y curl php5-cli php5-pgsql


COPY . /var/www
WORKDIR /var/www

