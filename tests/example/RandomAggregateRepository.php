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
        $connection->exec('create table test (id SERIAL, data jsonb);');
    }

    function testSaveAggregate() {

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $this->given($this->newTestedInstance($serializer, $this->getFactory()))
                ->object($this->testedInstance)
                ->isInstanceOf('lcefr\PostgreSqlRepository\AbstractPostgreSqlRepository')
                ->and($ag = new RandomAggregate('lcefr', 'laurent.cetinsoy@gmail.com'))
                ->and($id = $this->testedInstance->saveAggregate($ag))
                ->integer($id)
                ->isGreaterThan(0);
    }

    function testUpdateAggregate() {

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $this->given($this->newTestedInstance($serializer, $this->getFactory()))
                ->and($id = $this->testedInstance->saveAggregate(new RandomAggregate('before', 'laurentcetinsoy@gmail.com')))
                ->and($ag = new RandomAggregate('update', 'laurent.cetinsoy@gmail.com'))
                ->boolean($this->testedInstance->updateAggregate($id, $ag))
                ->isEqualTo(true);
    }

    function testGetAggregate() {


        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $this->given($this->newTestedInstance($serializer, $this->getFactory()))
                ->and($id = $this->testedInstance->saveAggregate(new RandomAggregate('before', 'laurentcetinsoy@gmail.com')))
                ->string($this->testedInstance->getAggregateById($id))
                ->contains('name')
                ->contains('before')
                ->contains('laurentcetinsoy@gmail.com');
    }

    function testFindBy() {

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);


        $this->given($this->newTestedInstance($serializer, $this->getFactory()))
                ->and($this->testedInstance->saveAggregate(new RandomAggregate('lol', 'my.email@pp.fr')))
                ->and($this->testedInstance->saveAggregate(new RandomAggregate('lol', 'you.me@dd.ff')))
                ->and($this->testedInstance->saveAggregate(new RandomAggregate('lal', 'jhjshdf@df.du')))
                ->array($this->testedInstance->findBy('name', 'lol'))
                ->hasSize(2);
    }

    function tearDown() {
        $connection = $this->getConnection();
        $connection->exec('drop table test');
    }

}
