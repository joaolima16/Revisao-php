<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . '/../vendor/autoload.php';

$config = ORMSetup::createAnnotationMetadataConfiguration(
    array(__DIR__ . "/../Entity"), // Caminho das suas entidades
    true                           // Modo desenvolvimento (isDevMode)
);

// Parâmetros de conexão
$connectionParams = [
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'dbname'   => 'store',
    'user'     => 'dev',
    'password' => 'dev123'
];

$connection = DriverManager::getConnection($connectionParams, $config);

$entityManager = EntityManager::create($connection, $config);