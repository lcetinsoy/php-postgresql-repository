docker build -t image-test -f Dockerfile ./
docker run --name pgsqld -p 5432:5432 -e POSTGRES_PASSWORD=test -d postgres:9.4 
docker run --name testing -v $(pwd):/var/www --link pgsqld:pgsqld -it image-test php /var/www/vendor/bin/atoum /var/www/test/ConnectionFactory.php
docker rm -v -f testing
docker rm -v -f pgsqld