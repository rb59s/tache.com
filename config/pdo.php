<?php
function connexionPDO(): \PDO{

$config = require(__DIR__ . "/_blogConfig.php");

    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";
  
    try{

        $pdo = new \PDO(
            $dsn, 
            $config["user"], 
            $config["password"],
            $config["options"] 
        );

		return $pdo;

    }catch(\PDOException $e){

        throw new \PDOException($e->getMessage(), (int)$e->getCode());
        die("Erreur de connexion : " . $e->getMessage());
    }
}


