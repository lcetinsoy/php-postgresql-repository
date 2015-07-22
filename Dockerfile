FROM debian:wheezy

MAINTAINER lcefr <laurent.cetinsoy@gmail.com>

RUN apt-get update 
RUN apt-get install -y php5-cli php5-pgsql

RUN php -m
VOLUME ["/var/www/:/var/www"]

EXPOSE 80 80
CMD ["php vendor/bin/atoum test/ConnectionFactory.php"]

