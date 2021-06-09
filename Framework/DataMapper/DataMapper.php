<?php

namespace Framework\DataMapper;

use src\lib\Database;
use src\lib\QueryBuilder;

abstract class DataMapper
{
    protected QueryBuilder $query;
    protected Database $db;
    public function __construct()
    {
        $this->query = new QueryBuilder();
        $this->db = Database::getInstance();
    }
}