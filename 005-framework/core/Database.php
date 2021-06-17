<?php

namespace app\core;

use Error;
use Exception;

class Database
{
    public \PDO $pdo;
    public function __construct(array $config)
    {
        //configuraciones en archivo .env
        $dsn = $config['dsn'] ?? '';
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';

        //echo $dsn ."\n";
        //echo $username. "\n";
        //echo $password . "\n";

        try {
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            echo "BD: CONECTADO!" . "\n";
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }

    }

    public function applyMigrations()
    {
        $this->createMigrationTable();
        $appliedMigrations = $this->getAppliedMigrations();
    }
    
    public function createMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `migrations` ( `id` INT NOT NULL AUTO_INCREMENT , `migration` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB; ");
    }
    
    public function getAppliedMigrations()
    {
        $sql = "SELECT migration From migrations";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);//devuelve array unidimensional
    }
}