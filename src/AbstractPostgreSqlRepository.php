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

    public function saveAggregate($aggregate) {

        $json = $this->serialize($aggregate);
        return $this->insertAsJson($json);
    }

    public function updateAggregate($id, $aggregate) {
        $json = $this->serialize($aggregate);
        return $this->updateAsJson($id, $json);
    }

    public function getAggregateById($id) {

        $prep = $this->connection->prepare('select data FROM ' . $this->getTableName() . ' WHERE id=:id');
        $prep->bindParam(':id', $id);
        $prep->execute();
        $result = $prep->fetch();
        return $result['data'];
    }

    protected function serialize($aggregate) {
        return $this->serializer->serialize($aggregate);
    }

    protected function insertAsJson($json) {

        $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $prep = $this->connection->prepare('insert into ' . $this->getTableName() . ' (data) VALUES (:json) RETURNING id');
        $prep->bindParam(':json', $json);
        $prep->execute();
        $id = $prep->fetch();
        return $id['id'];
    }

    protected function updateAsJson($id, $json) {

        $prep = $this->connection->prepare('update ' . $this->getTableName() . ' SET data =:json WHERE id=:id');

        $prep->bindParam(':id', $id);
        $prep->bindParam(':json', $json);
        return $prep->execute();
    }

}
