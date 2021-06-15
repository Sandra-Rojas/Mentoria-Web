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
        echo "Runnig applyMigrations\n";
    }
    
}