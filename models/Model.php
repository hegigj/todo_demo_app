<?php

namespace Models;

class Model extends Database
{
    protected string $tableName;

    public function __construct(string $tableName)
    {
        parent::__construct();
        $this->tableName = $tableName;
    }

    public function fetchAll(): array
    {
        $query = "SELECT * FROM $this->tableName";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $results =  $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    }

    public function fetchBy(array $condition): array
    {
        $query = "SELECT * FROM $this->tableName WHERE";

        foreach ($condition as $key=>$value) {
            $query .= " $key=:$key AND";
        }

        $query = substr($query, 0, strlen($query) - 4);

        $statement = $this->db->prepare($query);
        $statement->execute($condition);
        $results =  $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    }

    public function insert(array $insertValues): bool {
        $query = "INSERT INTO $this->tableName (";

        foreach ($insertValues as $key=>$value) {
            $query .= " $key,";
        }

        $query = substr($query, 0, strlen($query) - 1);
        $query .= " ) VALUES (";

        foreach ($insertValues as $key=>$value) {
            $query .= " :$key,";
        }

        $query = substr($query, 0, strlen($query) - 1);
        $query .= " )";

        var_dump($query, $insertValues);

        $statement = $this->db->prepare($query);
        $result = $statement->execute($insertValues);
        $statement->closeCursor();
        return $result;
    }
}