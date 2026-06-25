<?php
namespace App\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory{
    public static function create(): EntityManager{

        $dbParams = [
         'driver' => 'pdo_mysql',
         'host' => '127.0.0.1',
         'dbname' => 'store',
         'user' => 'dev',
         'password' => 'dev123'
     
        ];
        $config = ORMSetup::createXMLMetadataConfiguration([
            __DIR__ . '/../Config',
        ], true);
        $connection = DriverManager::getConnection($dbParams, $config);
        return new EntityManager($connection, $config);
    }
}