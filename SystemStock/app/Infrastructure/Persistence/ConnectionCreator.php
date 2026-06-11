<?php

namespace SystemStock\App\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO
    {
        $host = 'localhost';
        $dbName = 'store';
        $username = 'root';
        $port = '3306';
        $password = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=$charset";
        // echo("Conectando ao banco de dados...");
        return new PDO($dsn, $username, $password);
    }
}
