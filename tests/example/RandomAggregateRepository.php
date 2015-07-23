<?php

namespace tests\units\lcefr\PostgreSqlRepository\Example;

require __DIR__ . '/../../vendor/autoload.php';

use lcefr\PostgreSqlRepository\Example\RandomAggregate;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use tests\Test;

class RandomAggregateRepository extends Test {

    function setUp() {

        $connection = $this->getConnection();
        $connection->exec('create table test (id uuid, data jsonb);');
    }

    function testSaveAggregate() {

        $json = json_encode(array('name' => 'sdsdsd', 'attrnum' => array(1, 2, 3)));
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $this->given($this->newTestedInstance($serializer, $this->getFactory()))
                ->object($this->testedInstance)
                ->isInstanceOf('lcefr\PostgreSqlRepository\AbstractPostgreSqlRepository')
                ->and($ag = new RandomAggregate('lcefr', 'laurent.cetinsoy@gmail.com'))
                ->boolean($this->testedInstance->saveAggregate($ag))
                ->isEqualTo(true);
    }

    function tearDown() {
        $connection = $this->getConnection();
        $connection->exec('drop table test');
    }

}
