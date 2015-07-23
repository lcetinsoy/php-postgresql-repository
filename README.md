# php-postgresql-repository
A php postgresql repository for domain driven development

/!\ Not production ready yet /!\

##Installation

Composer package comming soon !

for now :

git clone https://github.com/lce-fr/php-postgresql-repository 

## Usage

Extends AbstractPostgreSqlRepository and implement getTableName method

Depending on your serializer you might want to override serialize method 


## Tests

composer update
./test.sh

Testing workflow can be improved, please tell me how:
  - How to wait that the postgresql server is setup before running test container please tell me !
  - What is the best way to add composer and installing vendor in the php image.

##Contributing

Fork, add, Test and pull request

Your help and suggestions are REALLY welcome.  

##Licence

MIT