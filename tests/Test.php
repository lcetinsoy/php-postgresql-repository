<?php

namespace tests;

use \atoum;

class Test extends atoum {

    function getPostGresIp() {
        $port = getenv('PGSQLD_PORT_5432_TCP_ADDR');
        
        return $port;
    }

    function getFactory() {
        return new \lcefr\PostgreSqlRepository\ConnectionFactory(
                $this->getPostGresIp(), '5432', 'postgres', 'postgres', 'test'
        );
    }

    function getConnection() {

        return $this->getFactory()->newConnection();
    }

}
