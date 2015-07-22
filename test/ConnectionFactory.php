<?php

namespace tests\units\PostgreSqlRepository;

require __DIR__ . '/../src/ConnectionFactory.php';

use atoum;

class ConnectionFactory extends atoum {

    function setUp() {
    }

    function testNewConnection() {

        $this->if($factory = new \PostgreSqlRepository\ConnectionFactory(
                        '127.0.0.1', '5432', 'postgres', 'postgres', 'test'
                ))
                ->then($connection = $factory->newConnection())
                ->object($connection)
                ->isInstanceOf('\PDO');
    }

    function tearDown() {

    }

}
