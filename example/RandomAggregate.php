<?php

namespace lcefr\PostgreSqlRepository\Example;

class RandomAggregate {

    private $name;
    private $email;

    function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function __toString() {
      return "coucou" ;
    }

}
