
MAINTAINER lcefr <laurent.cetinsoy@gmail.com>


RUN apt-get update 
RUN apt-get install -y php5-cli php5-pgsql
RUN apt-get install -y curl

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN php -m


EXPOSE 80 80
CMD ["php vendor/bin/atoum test/ConnectionFactory.php"]

