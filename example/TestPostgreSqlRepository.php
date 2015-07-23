<?php

namespace lcefr\PostgreSqlRepository\Example;

use \lcefr\PostgreSqlRepository\AbstractPostgreSqlRepository;

class TestPostgreSqlRepository extends AbstractPostgreSqlRepository {


    public function getTableName() {
        return 'test';
    }

}
