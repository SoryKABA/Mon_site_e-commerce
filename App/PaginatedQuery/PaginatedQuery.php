<?php

namespace App\PaginatedQuery;

class PaginatedQuery {

    private $statement;
    private $queryCount;
    public function __construct($statement, $queryCount)
    {
        $this->statement = $statement;
        $this->queryCount = $queryCount;
    }

    public function getItems($page) 
    {
        $pages = ceil($this->queryCount / 12);
         
    }
}