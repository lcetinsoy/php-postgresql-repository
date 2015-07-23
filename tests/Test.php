<?php

namespace tests;

use \atoum;

class Test extends atoum {

    function getPort() {
        $add = shell_exec('env | grep PGSQLD_PORT_5432_TCP_ADDR');
        $port = explode('=', $add);
        $port = trim($port[1]);
        return $port;
    }

    function getFactory() {
        return new \lcefr\PostgreSqlRepository\ConnectionFactory(
                $this->getPort(), '5432', 'postgres', 'postgres', 'test'
        );
    }

    function getConnection() {

        return $this->getFactory()->newConnection();
    }

}
