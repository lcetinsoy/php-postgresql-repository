docker run -p 5432:5432 --name pgsqld -e POSTGRES_PASSWORD=test -d postgres
if [ ! -d vendor ]; then
  composer update
fi
docker build -t image-test ./
sleep 6
docker run -ti --name testing --link pgsqld:pgsqld image-test php /var/www/vendor/bin/atoum -d /var/www/tests

docker rm -v -f testing
docker rm -v -f pgsqld
