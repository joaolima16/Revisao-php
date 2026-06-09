<?php
namespace Alura\Pdo\Infrastructure\Persistence;

class ConnectionCreator
{
    public static function createConnection(): \PDO
    {
        $databasePath = __DIR__ . DIRECTORY_SEPARATOR . '../../../bd.sqlite' ;
        $dsn = 'sqlite:' . str_replace('\\', '/', $databasePath);
        $pdo = new \PDO($dsn);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}