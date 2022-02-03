<?php

namespace Models;

use PDO;

class Database
{
    private string $host;
    private string $databaseName;
    private string $username;
    private string $password;
    private string $charset;

    protected PDO $db;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->databaseName = 'todo_list';
        $this->username = 'root';
        $this->password = 'root';
        $this->charset = 'utf8';

        $dns = "mysql:host=$this->host;dbname=$this->databaseName;charset=$this->charset";

        try {
            $this->db = new PDO($dns, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            exit();
        }
    }
}