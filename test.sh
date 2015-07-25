docker run -p 127.0.0.1:5432:5432 --name pgsqld -e POSTGRES_PASSWORD=test -d postgres
docker build -t image-test ./
docker run -ti --name testing --link pgsqld:pgsqld image-test php /var/www/vendor/bin/atoum -d /var/www/tests
docker rm -v -f testing
docker rm -v -f pgsqld