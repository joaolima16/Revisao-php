<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Helper/EntityManagerFactory.php';

try {
    $entityManager = EntityManagerFactory::create();
    $connection = $entityManager->getConnection();

    $result = $connection->fetchOne('SELECT 1');

    echo 'Conexao OK. Resultado: ' . $result . PHP_EOL;
    echo 'Banco: ' . $connection->getDatabase() . PHP_EOL;
} catch (Throwable $exception) {
    echo 'Erro ao conectar no banco:' . PHP_EOL;
    echo $exception->getMessage() . PHP_EOL;
    exit(1);
}
