<?php

namespace tests\units\PostgreSqlRepository;

use atoum;

class AbstractPostgreSqlRepository extends atoum {

    function setUp() {
        $connection = new \PostgreSqlRepository\ConnectionFactory();
        $connection = $connection->newConnection();
        $connection->exec('create table test (id integer, data json);');
    }

    function testSaveJson() {

        $json = json_encode(array('name' => 'test', 'data' => array(1, 2, 3)));

        $this->given($this->newTestedInstance)
                ->object($this->testedInstance)
                ->isInstanceOf('\PostgreSqlRepository\AbstractPostgreSqlRepository')
                ->boolean($this->testedInstance->saveJson('test', $json))
                ->isEqualTo(true);
    }

    function tearDown() {
       $connection->exec('drop table test');
    }

}
