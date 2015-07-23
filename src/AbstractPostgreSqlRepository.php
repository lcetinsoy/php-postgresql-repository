<?php

namespace lcefr\PostgreSqlRepository;

abstract class AbstractPostgreSqlRepository {

    protected $connection;
    protected $jsonSerializer;
    protected $tableName;

    function __construct($serializer, ConnectionFactory $factory) {
        $this->connection = $factory->newConnection();
        $this->jsonSerializer = $serializer;
    }

    protected function connect(ConnectionFactory $factory) {

        $this->connection = $factory->newConnection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function saveAggregate($table, $aggregate) {

        $json = $this->jsonSerializer->serialize($aggregate);
        $this->saveJson($table, $json);

        return $this;
    }

    abstract function getTableName();

    public function insertAsJson($json) {

        $prep = $this->connection->prepare('insert into ' . $this->getTableName() . ' (data) VALUES (:json)');
        $prep->bindParam(':json', $json);
        return $prep->execute();
    }

    protected function updateAsJson() {
        
    }

    public function getAggregateById($id, $aggregateName) {

        $prep = $conn->prepare('select ' . $aggregateName . '');
        $prep->bindParam(':json', $json);
        return $prep->execute();
    }

}
