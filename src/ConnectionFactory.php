<?php

namespace PostgreSqlRepository;

class ConnectionFactory {

    protected $host;
    protected $port;
    protected $user;
    protected $database;
    protected $password;

    function __construct($host, $port, $database, $user, $password) {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->database = $database;
        $this->password = $password;
    }

    function newConnection() {

        var_dump($this->host);
        $connection = new \PDO('pgsql:host=' . $this->host . 
                        ';port=' . $this->port . 
                        ';dbname=' . $this->database, 
                        $this->user, 
                        $this->password);
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
                return $connection;
    }

}
