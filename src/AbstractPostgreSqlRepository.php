<?php

namespace lcefr\PostgreSqlRepository;

abstract class AbstractPostgreSqlRepository {

    protected $connection;
    protected $serializer;
    protected $tableName;

    function __construct($serializer, ConnectionFactory $factory) {
        $this->connection = $factory->newConnection();
        $this->serializer = $serializer;
    }

    abstract function getTableName();

    public function saveAggregate($table, $aggregate) {

        $json = $this->serialize($aggregate);
        return $this->insertAsJson($table, $json);
    }

    public function updateAggregate(){


    }

    public function getAggregateById($id, $aggregateName) {

        $prep = $conn->prepare('select data FROM ' . $aggregateName . 'WHERE id=:id');
        $prep->bindParam(':id', $id);
        return $prep->execute();
    }

    protected function serialize($aggregate) {
        return $this->serializer->serialize($aggregate);
    }

    protected function insertAsJson($json) {

        $prep = $this->connection->prepare('insert into ' . $this->getTableName() . ' (data) VALUES (:json)');
        $prep->bindParam(':json', $json);
        return $prep->execute();
    }

    protected function updateAsJson($id, $json) {

        $prep = $this->connection->prepare('update ' . $this->getTableName() . 'SET (data) VALUES(:json) WHERE id=:id');

        $prep->bindParam(':id', $id);
        $prep->bindParam(':json', $json);
        return $prep->execute();
    }

}
