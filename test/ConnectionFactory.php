<?php

namespace tests\units\PostgreSqlRepository;

require __DIR__ . '/../src/ConnectionFactory.php';

use atoum;

class ConnectionFactory extends atoum {

    protected $addr;

    function setUp() {
        
    }

    function testNewConnection() {

        $this->if($factory = new \PostgreSqlRepository\ConnectionFactory(
                $this->getPort() , '5432', 'postgres', 'postgres', 'test'
                ))
                ->then($connection = $factory->newConnection())
                ->object($connection)
                ->isInstanceOf('\PDO');
    }

    function tearDown() {
        
    }

    function getPort() {
        $add = shell_exec('env | grep PGSQLD_PORT_5432_TCP_ADDR');
        echo shell_exec('env');
        $port = explode('=', $add);

        $port = trim($port[1]);
        return $port;
    }

}
