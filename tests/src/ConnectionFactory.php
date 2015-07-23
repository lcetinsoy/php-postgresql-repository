<?php

namespace tests\units\lcefr\PostgreSqlRepository;

require __DIR__ . '/../../vendor/autoload.php';

use tests\Test;

class ConnectionFactory extends Test {

    protected $addr;

    function setUp() {
        
    }

    function testNewConnection() {

        $this->if($factory = new \lcefr\PostgreSqlRepository\ConnectionFactory(
                $this->getPort() , '5432', 'postgres', 'postgres', 'test'
                ))
                ->then($connection = $factory->newConnection())
                ->object($connection)
                ->isInstanceOf('\PDO');
    }

    function tearDown() {
        
    }
}
