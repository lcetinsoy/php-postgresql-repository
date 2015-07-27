# php-postgresql-repository
A php postgresql repository for domain driven development


##Installation

composer require lcefr/postgresql-json-repository dev-master

## Usage

Each aggreagate is fully stored in a jsonb data column.

Extends AbstractPostgreSqlRepository and implement getTableName method.

Depending on your serializer you might want to override serialize method. 


## Tests

cd vendor/lcefr/postgresql-json-repository && ./test.sh

Testing workflow can be improved, please tell me how:
  - How to wait that the postgresql server is setup before running test container 
  - How to only run once "composer update" to increase testing speed.

##Contributing

Fork, add, Test and pull request

Your help and suggestions are REALLY welcome.  

##Licence

MIT