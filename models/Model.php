<?php

include __DIR__.'/Database.php';

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
        $results =  $statement->fetchAll(PDO::FETCH_OBJ);
        $statement->closeCursor();
        return $results;
    }

    public function fetchBy(array $condition): array
    {
        $query = "SELECT * FROM $this->tableName WHERE";

        foreach ($condition as $key=>$value) {
            $query .= ":$key=$value";
        }

        $statement = $this->db->prepare($query);
        foreach ($condition as $key=>$value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();

        $results =  $statement->fetchAll(PDO::FETCH_OBJ);
        $statement->closeCursor();
        return $results;
    }
}