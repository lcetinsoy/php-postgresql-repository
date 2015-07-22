<?php

namespace PostgreSqlRepository;

class AbstractPostgreSqlRepository {

    protected $connection;
    private $jsonSerializer;

    function __construct(JsonSerializerInterface $serializer) {
        $this->jsonSerializer = $serializer;
    }

    protected function connect(PostGreSQLConnectionFactory $factory) {

        $this->connection = $factory->newConnection();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function serialize($aggregate) {

        $this->jsonSerializer->serialize($aggregate);
        return $this;
    }

    function saveJson($tableName, $json) {

        $prep = $conn->prepare('select ' . $tableName . '(:json)');
        $prep->bindParam(':json', $json);
        $prep->execute();
    }

    function getJson() {

        $prep = $conn->prepare('select insertPerson(:json)');
        $prep->bindParam(':json', $json);
        return $prep->execute();
    }

}
