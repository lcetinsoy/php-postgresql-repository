<?php

namespace lcefr\PostgreSqlRepository\Example;

use \lcefr\PostgreSqlRepository\AbstractPostgreSqlRepository;

class RandomAggregateRepository extends AbstractPostgreSqlRepository {

    public function getTableName() {
        return 'test';
    }

    protected function serialize($aggregate) {
        return $this->serializer->serialize($aggregate, 'json');
    }

}
