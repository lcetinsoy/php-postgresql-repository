docker build -t postgresqlrepository-test ./
docker rm -v pgsqld 
docker run --name pgsqld -p 5432:5432 -e POSTGRES_PASSWORD=test -d postgres:9.4 
docker run -v $(pwd):/var/www --rm --link pgsqld:pgsqld -it postgresqlrepository-test php /var/www/vendor/bin/atoum /var/www/test/ConnectionFactory.php