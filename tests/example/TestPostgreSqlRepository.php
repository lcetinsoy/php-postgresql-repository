<?php

namespace tests\units\lcefr\PostgreSqlRepository\Example;

require __DIR__ . '/../../vendor/autoload.php';

use tests\units\lcefr\PostgreSqlRepository\ConnectionFactory;
use tests\Test;

class TestPostgreSqlRepository extends Test {

    function setUp() {

        $connection = $this->getConnection();
        $connection->exec('create table test (id uuid, data jsonb);');
    }

    function testInsertAsJson() {

        $json = json_encode(array('name' => 'sdsdsd', 'attrnum' => array(1, 2, 3)));

        $this->given($this->newTestedInstance(null, $this->getFactory()))
                ->object($this->testedInstance)
                ->isInstanceOf('lcefr\PostgreSqlRepository\AbstractPostgreSqlRepository')
                ->boolean($this->testedInstance->insertAsJson($json))
                ->isEqualTo(true);
    }

    function tearDown() {
        $connection = $this->getConnection();
        $connection->exec('drop table test');
    }

}
