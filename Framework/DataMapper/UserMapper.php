<?php

namespace Framework\DataMapper;

use Framework\DataMapper\DataMapper;
use src\Model\User;

class UserMapper extends DataMapper
{
    public function getUserById(int $id): ?User
    {
        $params = [':id' => $id];
        $sql = $this->query->select() .
            $this->query->from($this->getTableName()) .
            $this->query->where(['id'], '=');
        $result = $this->db->query($sql, $params);
        return $result ? $this->mapToUser($result[0]) : null;
    }
    public function getUsersList(): array
    {
        $sql = $this->query->select() .
            $this->query->from($this->getTableName());
        $result = $this->db->query($sql);
        $productArr = [];
        for ($i = 0; $i < count($result); $i++) {
            $productArr[] = User::getDataFromUserMapper($result[$i]);
        }
        return $productArr;
    }
    public function getUserByColumns(array $column)
    {
        $paramToDb = [];
        $valueToQuery = [];
        if (!empty($column)) {
            foreach ($column as $key => $value) {
                $param = ':' . $key;
                $valueToQuery[] = $key . '=' . $param;
                $paramToDb[$param] = $value;
            }
            $sql = 'SELECT *' .
                ' FROM ' .
                $this->getTableName() .
                ' WHERE ' .
                implode(' AND ', $valueToQuery);
            $result = $this->db->query($sql, $paramToDb);
            return $result ? $this->mapToUser($result[0]) : null;
        }
    }
    public function insert(User $user)
    {
        $paramToQuery = [];
        $valueToQuery = [];
        $paramToDb = [];
        array_filter((array)$user);
        foreach ($user as $key => $value) {
            if ($key !== 'id') {
                $param = $this->transformToNormalFormat($key);
                $paramKeyFormat = ':' . $param;
                $paramToQuery[] = $param;
                $valueToQuery[] = $paramKeyFormat;
                $paramToDb[$paramKeyFormat] = $value;
            }
        }
        $sql = 'INSERT INTO ' .
            $this->getTableName() .
            '(' .
            implode(',', $paramToQuery) .
            ') VALUES (' .
            implode(',', $valueToQuery) .
            ')';
        $this->db->query($sql, $paramToDb);
    }
    public function update(User $user)
    {
        $paramToQuery = [];
        $valueToQuery = [];
        $paramToDb = [];
        $id = $user->getId();
        array_filter((array)$user);
        foreach ($user as $key => $value) {
            if ($key !== 'id' && $key !== 'createdAt') {
                $param = $this->transformToNormalFormat($key);
                $paramKeyFormat = ':' . $param;
                $paramToQuery[] = $param . '=' . $paramKeyFormat;
                $paramToDb[$paramKeyFormat] = $value;
            }
        }
        $paramToDb[':id'] = $id;
        $sql = 'UPDATE ' .
            $this->getTableName() .
            ' SET ' .
            implode(',', $paramToQuery) .
            ' WHERE id=:id';
        $this->db->query($sql, $paramToDb);
    }
    public function delete(User $user)
    {
        if (!empty($user->getId())) {
            $paramToDb[':id'] = $user->getId();
            $sql = 'DELETE FROM ' .
                $this->getTableName() .
                ' WHERE id=:id';
            $this->db->query($sql, $paramToDb);
        }
    }
    private function getTableName(): string
    {
        return 'users';
    }
    private function mapToUser(array $rows): User
    {
        return User::getDataFromUserMapper($rows);
    }
    private function transformToNormalFormat(string $str): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
    }
}
