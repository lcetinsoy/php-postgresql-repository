docker run -p 127.0.0.1:5432:5432 --name pgsqld -e POSTGRES_PASSWORD=test -d postgres
composer update
docker build -t image-test ./
docker run -ti --name testing -v $(pwd):/var/www --link pgsqld:pgsqld image-test php /var/www/vendor/bin/atoum /var/www/test/ConnectionFactory.php
docker rm -v -f testing
docker rm -v -f pgsqld