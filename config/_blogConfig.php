<?php
// La superglobale $_ENV en PHP sert à accéder aux variables d’environnement du système dans lequel ton script s’exécute.
return [
    "host" => $_ENV["DB_HOST"] ?? "db", 
    "port" => $_ENV["DB_PORT"] ?? "3306",     
    "database" => $_ENV["DB_NAME"] ?? "todolist",       
    "user" => $_ENV["DB_USER"] ?? "rayan",   
    "password" => $_ENV["DB_PASSWORD"] ?? "secret",
    "charset" => "utf8mb4",              
    "options" => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  
        PDO::ATTR_EMULATE_PREPARES => false            
    ]
];
?>
