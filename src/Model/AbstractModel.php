<?php


namespace ToDoApp\Model;


use PDOException;
use ToDoApp\Exception\ConfigurationException;
use PDO;
use ToDoApp\Exception\StorageException;

abstract class AbstractModel
{
    protected PDO $db_conn;

    public function __construct(array $config)
    {
        try {
            $this->validateConnection($config);
            $this->createConnection($config);
        } catch (PDOException $e) {
            throw new StorageException("Connection error.");
        }

    }
    private function createConnection(array $config)
    {
        $dsn = "mysql:dbname=".$config['db_name'].";host=".$config['host'];
        $user = $config['user'];
        $password = $config['password'];
        $this->db_conn = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
    private function validateConnection(array $config)
    {
        if (empty($config['user']) ||
            empty($config['password']) ||
            empty($config['db_name']) ||
            empty($config['host'])) {
            throw new ConfigurationException("Storage configuration error");
        }
    }
}