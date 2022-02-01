<?php

class Database
{
    private string $host;
    private string $databaseName;
    private string $username;

    protected PDO $db;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->databaseName = 'todo_list';
        $this->username = 'root';

        $dns = "mysql:host=$this->host;dbName=$this->databaseName;charset=UTF8";

        try {
            $this->db = new PDO($dns, $this->username);
        } catch (PDOException $e) {
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            exit();
        }
    }
}