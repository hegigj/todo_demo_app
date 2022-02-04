<?php

namespace Models;

use PDO;

class Model extends Database
{
    protected string $tableName;
    protected array $fields;

    public function __construct(string $tableName)
    {
        parent::__construct();
        $this->tableName = $tableName;
    }

    public function fetchPaginatedBy(int $limit, int $offset, array $conditions): array
    {
        $fieldsConditions = [];
        $query = "SELECT * FROM $this->tableName WHERE";
        foreach ($conditions as $key=>$value) {
            if (in_array($key, $this->fields)) {
                $fieldsConditions[$key] = $value;
                $query .= " $key=:$key AND";
            }
        }
        $query = substr($query, 0, strlen($query) - 3);
        $query .= "LIMIT :limit OFFSET :offset";

        $statement = $this->db->prepare($query);
        foreach ($fieldsConditions as $key=>$value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    }

    public function fetchBy(array $conditions): array
    {
        $query = "SELECT * FROM $this->tableName WHERE";

        foreach ($conditions as $key=>$value) {
            $query .= " $key=:$key AND";
        }

        $query = substr($query, 0, strlen($query) - 4);

        $statement = $this->db->prepare($query);
        $statement->execute($conditions);
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