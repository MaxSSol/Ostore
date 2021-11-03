<?php

namespace src\lib;

class QueryBuilder
{
    public function select(array $params = []): string
    {
        if (!empty($params)) {
            $body = '';
            foreach ($params as $item) {
                $body .= $item . ',';
            }
            return 'SELECT ' . trim($body, ',') . ' ';
        }
        return 'SELECT *';
    }
    public function from(string $tableName): string
    {

        return ' FROM ' . $tableName;
    }

    public function where(array $params, string $sign): string
    {
        $body = '';
        foreach ($params as $item) {
            $body .= $item . $sign . ':' . $item . ',';
        }

        return ' WHERE ' . trim($body, ',');
    }
}
