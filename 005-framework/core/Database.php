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
        $username = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        // echo "en Database.php \n";
        // echo "dsn: " . $dsn ."\n";
        // echo "user: ". $username. "\n";
        // echo "password: " . $password . "\n";

        try {
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            //echo "BD: CONECTADO!" . "\n";
        }
        catch(Error $ex){
            echo $ex->getMessage();
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }

    }

    public function applyMigrations()
    {
        $this->createMigrationTable();
        $newMigrations = []; 
        $appliedMigrations = $this->getAppliedMigrations();
        
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        // echo '<pre>';
        // var_dump($files);
        // echo '</pre>';
        // exit;
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach($toApplyMigrations as $migration){
            if($migration === '.' || $migration === '..'){
                continue;
            }
            require_once Application::$ROOT_DIR . '/migrations/' .$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME); //devuelve nombre arch sin extension
            $instance = new $className();
            echo "Applying migration $migration\n";
            $instance->up();
            echo "Applied migration $migration\n";

            $newMigrations[] = $migration;
            echo "a";
            var_dump($newMigrations);
        }

        if (!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }else {
            echo "All migration has been applied\n";
        }
    }
    
    public function createMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `migrations` ( `id` INT NOT NULL AUTO_INCREMENT , `migration` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; ");     
    }
    
    public function getAppliedMigrations()
    {
        $sql = "SELECT migration From migrations";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);//devuelve array unidimensional
    }

    public function saveMigrations(array $newMigrations)
    {
        //insert into migrations (migration) VALUES
        //m1000,m2000,m3
        var_dump($newMigrations);
        $values = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        echo "values:" . $values;
        $statement = $this->pdo->prepare ("INSERT INTO migrations (migration) VALUES $values");
        $statement->execute();

   }
}